<?php

declare(strict_types=1);

namespace Stelin;

use RuntimeException;

/**
 * Cryptographic helpers used by the login/register flow.
 */
final class Crypto
{
    /**
     * RSA-encrypt then base64-encode, using PKCS#1 v1.5 padding (not OAEP).
     */
    public static function rsaEncrypt(string $plaintext, string $publicKeyPem): string
    {
        $key = self::normalizePem($publicKeyPem);
        $encrypted = '';

        if (!openssl_public_encrypt($plaintext, $encrypted, $key, OPENSSL_PKCS1_PADDING)) {
            throw new RuntimeException('RSA encryption failed: ' . (openssl_error_string() ?: 'unknown error'));
        }

        return base64_encode($encrypted);
    }

    private static function normalizePem(string $key): string
    {
        if (str_contains($key, '-----BEGIN')) {
            return $key;
        }

        return "-----BEGIN PUBLIC KEY-----\n{$key}\n-----END PUBLIC KEY-----";
    }

    /**
     * Plaintext for the login/register `credentials.password.value` field, before RSA
     * encryption. Format:
     *
     *   "{type}|{securityCode}|{timestampMillis}|{uuid}|{phone-0-prefix}|{deviceId}|{otpRefId}"
     *
     * @param 'LOGIN'|'CREATE' $type   "LOGIN" for `loginWithPin()`, "CREATE" for registration.
     * @param string $securityCode     The 6-digit OVO PIN.
     * @param string $msisdn           Any format; normalized to a "0"-prefixed local number
     *                                 (the literal string "+62" is replaced with "0").
     */
    public static function buildAuthSignaturePayload(
        string $type,
        string $securityCode,
        string $msisdn,
        string $deviceId,
        string $otpRefId,
    ): string {
        $timestampMillis = (string) (int) round(microtime(true) * 1000);
        $phone = str_replace('+62', '0', $msisdn);

        return implode('|', [$type, $securityCode, $timestampMillis, self::uuidV4(), $phone, $deviceId, $otpRefId]);
    }

    /**
     * SHA-1(trxId||amount||deviceId), with no secret key. Used for
     * `UnlockValidatePayload.signature` (`PaymentSecurityService::unlockAndValidateTrxId`),
     * triggered when a QR payment fails with response code `10010001`.
     */
    public static function trxSignature(string $trxId, string $amount, string $deviceId): string
    {
        return sha1("{$trxId}||{$amount}||{$deviceId}");
    }

    /** Cryptographically random UUID v4 (RFC 4122). */
    public static function uuidV4(): string
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);

        $hex = bin2hex($bytes);

        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12),
        );
    }

    /**
     * Signature for `POST /wallet/purchase/qr`.
     *
     * ⚠️ The signature algorithm is not yet well-known, so treat this as experimental. This
     * implements the most common gateway pattern (HMAC-SHA256 over a stable-ordered body +
     * timestamp); the endpoint may reject requests until the real algorithm is verified.
     *
     * @param array<string, mixed>|string $body
     *
     * @return array{0: string, 1: string} [signature, time]
     */
    public static function signQrPayment(array|string $body, string $secret, ?string $timestamp = null): array
    {
        $time = $timestamp ?? gmdate('Y-m-d\TH:i:s\Z');
        $raw = is_string($body) ? $body : self::stableStringify($body);
        $sig = hash_hmac('sha256', $raw . '|' . $time, $secret);

        return [$sig, $time];
    }

    /** Deterministic JSON stringify with sorted keys (stable signature input). */
    public static function stableStringify(mixed $value): string
    {
        return json_encode(self::sortKeys($value), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    private static function sortKeys(mixed $value): mixed
    {
        if (is_array($value) && array_is_list($value)) {
            return array_map([self::class, 'sortKeys'], $value);
        }

        if (is_array($value)) {
            ksort($value);

            return array_map([self::class, 'sortKeys'], $value);
        }

        return $value;
    }

    private function __construct()
    {
        // Static helper holder only.
    }
}
