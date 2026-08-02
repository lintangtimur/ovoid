<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;
use Stelin\Crypto;

/**
 * Wallet unlock & transaction re-validation.
 *
 * NOTE: `securityCode` here is the PIN sent in PLAINTEXT (`UnlockPayload` has no `algo`/RSA
 * field) — this is different from the RBA PIN, which IS RSA-encrypted (see AuthService).
 */
final class SecurityService
{
    private const PATH_UNLOCK = 'v1.0/api/auth/customer/unlock';
    private const PATH_UNLOCK_ACTION_MARK = 'v1.0/api/auth/customer/unlockWithActionMark';
    private const PATH_UNLOCK_VALIDATE_TRX = 'v1.0/api/auth/customer/unlockAndValidateTrxId';

    public function __construct(private readonly Client $client)
    {
    }

    /** POST /v1.0/api/auth/customer/unlock — unlock the wallet with the PIN. */
    public function unlock(string $securityCode, string $appVersion): array
    {
        return $this->client->post(self::PATH_UNLOCK, [
            'securityCode' => $securityCode,
            'appVersion'   => $appVersion,
        ]);
    }

    /** POST .../unlockWithActionMark — unlock and tag an action (e.g. an amount). */
    public function unlockActionMark(string $securityCode, string $actionMark, string $amount, string $version): array
    {
        return $this->client->post(self::PATH_UNLOCK_ACTION_MARK, [
            'securityCode' => $securityCode,
            'actionMark'   => $actionMark,
            'amount'       => $amount,
            'version'      => $version,
        ]);
    }

    /**
     * POST .../unlockAndValidateTrxId — re-validate the PIN after a QR payment failed with
     * error code `10010001`. The `signature` (SHA-1 — see {@see Crypto::trxSignature})
     * is computed automatically when both `$amount` and `$deviceId` are provided.
     *
     * @param string      $trxId
     * @param string      $securityCode PIN plaintext
     * @param string      $version
     * @param string|null $signature    override manually; skipped (auto-computed) when $amount+$deviceId given and signature null
     * @param string|null $amount       required for auto-computed signature
     * @param string|null $deviceId     required for auto-computed signature
     */
    public function unlockAndValidateTrxId(
        string $trxId,
        string $securityCode,
        string $version,
        ?string $signature = null,
        ?string $amount = null,
        ?string $deviceId = null,
    ): array {
        $sig = $signature ?? (($amount !== null && $deviceId !== null)
            ? Crypto::trxSignature($trxId, $amount, $deviceId)
            : null);

        $body = [
            'trxId'        => $trxId,
            'securityCode' => $securityCode,
            'version'      => $version,
        ];
        // Only include `signature` when it can be computed. Mirrors the JS behaviour where an
        // undefined value is dropped from the body (the server may reject an explicit null).
        if ($sig !== null) {
            $body['signature'] = $sig;
        }

        return $this->client->post(self::PATH_UNLOCK_VALIDATE_TRX, $body);
    }
}
