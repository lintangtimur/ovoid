<?php

declare(strict_types=1);

namespace Stelin\Service;

use RuntimeException;
use Stelin\Client;
use Stelin\Config;
use Stelin\Crypto;

/**
 * Login, registration, and OTP.
 *
 * Login always requires a validated OTP first, even for accounts with a PIN already set:
 *
 *  1. {@see requestOtp()}    — server sends a code by SMS (or a magic link — see `reff_type`).
 *  2. {@see validateOtp()}   — exchanges the code for an `otp_token`.
 *  3. {@see loginWithPin()}  — sends `otp_token` *and* the RSA-encrypted PIN together.
 */
final class AuthService
{
    private const PATH_PUBLIC_KEYS = 'v3/user/public_keys';
    private const PATH_ONBOARDING_TYPE = 'v3/user/accounts/onboardingType';
    private const PATH_OTP = 'v3/user/accounts/otp';
    private const PATH_OTP_VALIDATION = 'v3/user/accounts/otp/validation';
    private const PATH_LOGIN = 'v3/user/accounts/login';
    private const PATH_REGISTER = 'v3/user/accounts';
    private const PATH_STEPUP_INITIATE = 'v3/user/stepup/initiate';
    private const PATH_STEPUP_VALIDATE = 'v3/user/stepup/validate';

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * Existing users with a PIN already set skip OTP entirely.
     *
     * @return array{next: 'PIN_ENTRY'|'OTP_VERIFY'|'MAGIC_LINK'|'UNKNOWN', authType: ?string, otp: ?array}
     */
    public function resolveOnboardingType(string $msisdn, string $deviceId): array
    {
        $data = $this->client->post(self::PATH_ONBOARDING_TYPE, [
            'msisdn' => $msisdn,
            'device_id' => $deviceId,
            'otp' => ['type' => null, 'sms_hash' => null, 'locale' => 'ID'],
            'channel_code' => Config::CHANNEL_CODE,
        ]);

        $authType = $data['auth_type'] ?? null;
        $otp = $data['otp'] ?? null;

        $next = match (true) {
            $authType === 'PIN' => 'PIN_ENTRY',
            $authType === 'OTP_PIN' && ($otp['reff_type'] ?? null) === 'LINK' => 'MAGIC_LINK',
            $authType === 'OTP_PIN' => 'OTP_VERIFY',
            default => 'UNKNOWN',
        };

        return ['next' => $next, 'authType' => $authType, 'otp' => $otp];
    }

    /** @return array{otp: array{otp_ref_id: string, type: string, reff_type: ?string, length: ?int, cooldown_period: ?int}} */
    public function requestOtp(string $msisdn, string $deviceId, ?string $smsHash = null): array
    {
        return $this->client->post(self::PATH_OTP, [
            'msisdn' => $msisdn,
            'device_id' => $deviceId,
            'otp' => ['type' => null, 'sms_hash' => $smsHash, 'locale' => 'ID'],
            'channel_code' => Config::CHANNEL_CODE,
        ]);
    }

    /**
     * @param string $type Required — the server rejects this call with
     *                      `OV00002 "type: non zero value required"` if empty. Pass through
     *                      whatever {@see requestOtp()}'s `otp.type` returned.
     * @return array{otp: array{otp_ref_id: string, otp_token: string, type: string}}
     */
    public function validateOtp(string $msisdn, string $deviceId, string $otp, string $otpRefId, string $type): array
    {
        return $this->client->post(self::PATH_OTP_VALIDATION, [
            'msisdn' => $msisdn,
            'device_id' => $deviceId,
            'otp' => ['type' => $type, 'otp_ref_id' => $otpRefId, 'otp' => $otp],
            'channel_code' => Config::CHANNEL_CODE,
        ]);
    }

    /**
     * The server's current RSA public key (PEM), used to encrypt the PIN before sending it.
     *
     * @param string|null $scope Filter by `PublicKey.scope` when the account has more than one
     *                            key for different purposes. Valid values are not publicly listed;
     *                            omit to just take the first key returned (works for login/RBA today).
     */
    public function loadPublicKey(?string $scope = null): string
    {
        $data = $this->client->get(self::PATH_PUBLIC_KEYS);
        $keys = $data['keys'] ?? [];

        $match = $scope === null
            ? ($keys[0] ?? null)
            : $this->firstKeyWithScope($keys, $scope);

        if (!isset($match['key'])) {
            throw new RuntimeException('No matching key present in PublicKeysResponse.keys[].');
        }

        return $match['key'];
    }

    /** @param array<int, array{key?: string, scope?: array<int, string>}> $keys */
    private function firstKeyWithScope(array $keys, string $scope): ?array
    {
        foreach ($keys as $key) {
            if (in_array($scope, $key['scope'] ?? [], true)) {
                return $key;
            }
        }

        return null;
    }

    /**
     * @param string $otpToken from {@see validateOtp()}'s `otp.otp_token`.
     * @param string $otpRefId from {@see validateOtp()}'s `otp.otp_ref_id`.
     * @return array{account: array, auth: array{access_token: string, refresh_token: string, expires_in: int, token_type: string}}
     */
    public function loginWithPin(
        string $msisdn,
        string $pin,
        string $deviceId,
        string $otpToken,
        string $otpRefId,
        ?string $pushNotificationId = null,
    ): array {
        $publicKey = $this->loadPublicKey();
        $payload = Crypto::buildAuthSignaturePayload('LOGIN', $pin, $msisdn, $deviceId, $otpRefId);

        return $this->client->post(self::PATH_LOGIN, [
            'msisdn' => $msisdn,
            'device_id' => $deviceId,
            // Required non-empty by the server (OV00002 otherwise); the app itself
            // sends the real FCM token here, a fallback device id is good enough for API use.
            'push_notification_id' => $pushNotificationId ?? $deviceId,
            'channel_code' => Config::CHANNEL_CODE,
            'credentials' => [
                'otp_token' => $otpToken,
                'password' => ['value' => Crypto::rsaEncrypt($payload, $publicKey), 'format' => 'rsa'],
            ],
        ]);
    }

    /** @return array{account: array, auth: array} */
    public function registerWithPin(
        string $msisdn,
        string $pin,
        string $deviceId,
        string $otpToken,
        string $otpRefId,
        ?string $fullName = null,
        ?string $pushNotificationId = null,
    ): array {
        $publicKey = $this->loadPublicKey();
        $payload = Crypto::buildAuthSignaturePayload('CREATE', $pin, $msisdn, $deviceId, $otpRefId);

        return $this->client->post(self::PATH_REGISTER, [
            'account' => [
                'name' => $fullName,
                'msisdn' => $msisdn,
                'device_id' => $deviceId,
                'push_notification_id' => $pushNotificationId ?? $deviceId,
            ],
            'credentials' => [
                'otp_token' => $otpToken,
                'password' => ['value' => Crypto::rsaEncrypt($payload, $publicKey), 'format' => 'rsa'],
            ],
            'channel_code' => Config::CHANNEL_CODE,
        ]);
    }

    /* ------------------------------ RBA (step-up) ------------------------------ */

    /**
     * POST /v3/user/stepup/initiate — trigger a risk-based step-up challenge (PIN/OTP) before
     * a sensitive operation.
     *
     * @return array{action_data: array, auth_id: string, next_action: string}
     */
    public function stepUpInitiate(string $riskCtxId, string $stateParam): array
    {
        return $this->client->post(self::PATH_STEPUP_INITIATE, [
            'risk_ctx_id' => $riskCtxId,
            'state_param' => $stateParam,
        ]);
    }

    /**
     * POST /v3/user/stepup/validate with a RSA-encrypted PIN. The PIN is encrypted with the
     * server's public key (see {@see loadPublicKey()}), `algo: "rsa"`.
     *
     * @param string      $pinPlain     the 6-digit PIN
     * @param string      $authId       from {@see stepUpInitiate()}
     * @param string|null $publicKeyPem reuses {@see loadPublicKey()} when omitted
     */
    public function verifyPin(string $pinPlain, string $authId, ?string $publicKeyPem = null): array
    {
        $pem = $publicKeyPem ?? $this->loadPublicKey();

        return $this->client->post(self::PATH_STEPUP_VALIDATE, [
            'auth_id'     => $authId,
            'action_type' => 'pin',
            'action_data' => ['algo' => 'rsa', 'pin' => Crypto::rsaEncrypt($pinPlain, $pem)],
        ]);
    }

    /**
     * POST /v3/user/stepup/validate with a PLAINTEXT OTP (the `OtpVerification` DTO has no
     * `algo`/RSA field, so the OTP is sent as-is — different from the PIN path).
     *
     * @param string $otpPlain  6-digit OTP
     * @param string $otpRefId  `OtpVerification.otp_ref_id`, usually from initiate/resend
     * @param string $authId    from {@see stepUpInitiate()}
     */
    public function verifyOtp(string $otpPlain, string $otpRefId, string $authId): array
    {
        return $this->client->post(self::PATH_STEPUP_VALIDATE, [
            'auth_id'     => $authId,
            'action_type' => 'otp',
            'action_data' => ['otp_ref_id' => $otpRefId, 'otp' => $otpPlain],
        ]);
    }

    /** POST /v3/user/stepup/initiate again — also used to resend a step-up OTP (same endpoint). */
    public function resendOtp(string $riskCtxId, string $stateParam): array
    {
        return $this->stepUpInitiate($riskCtxId, $stateParam);
    }
}
