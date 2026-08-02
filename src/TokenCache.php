<?php

declare(strict_types=1);

namespace Stelin;

/**
 * Optional file-based caches for the login session and for an in-flight OTP request, so
 * repeated local runs don't need a fresh OTP every time.
 *
 * IMPORTANT: `auth['expires_in']` is named like an OAuth2 duration in seconds, but its
 * VALUE is empirically an absolute epoch-seconds timestamp — treating it as a literal
 * duration works out to roughly 56 years, while treating it as a timestamp lines up with
 * the ~24h session length OVO actually uses. This class compares it directly against
 * `time()`, not `time() + value`.
 */
final class TokenCache
{
    /** @return array{access_token: string, refresh_token: string, expires_in: int, token_type: string}|null */
    public static function load(string $path): ?array
    {
        if (!is_file($path)) {
            return null;
        }

        $cached = json_decode((string) file_get_contents($path), true);

        if (!is_array($cached) || empty($cached['access_token']) || empty($cached['expires_in'])) {
            return null;
        }

        if (time() >= (int) $cached['expires_in']) {
            return null;
        }

        return $cached;
    }

    /** @param array<string, mixed> $auth The `auth` value returned by `AuthService::loginWithPin()`. */
    public static function save(string $path, array $auth): void
    {
        file_put_contents($path, json_encode($auth, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));
    }

    /**
     * Cache for an OTP that has already been requested (SMS sent, waiting on user input).
     *
     * Needed because the server rate-limits {@see \Stelin\Service\AuthService::requestOtp()}
     * (`OV00015`) when it's called again before `cooldown_period` elapses — but the
     * `otp_ref_id` from the PREVIOUS successful request (and its SMS) is still valid until
     * `otp.expires_at`. Without this cache, hitting the cooldown on a second run means you
     * cannot proceed at all, even though the SMS already arrived.
     *
     * @param bool $ignoreExpiry Return the cached value even past `expires_at` — useful while
     *                            the server is in cooldown, so the OTP is still attempted and
     *                            the SERVER (not a possibly-wrong local guess) decides validity.
     * @return array{otp_ref_id: string, type: string, expires_at?: int}|null
     */
    public static function loadPendingOtp(string $path, bool $ignoreExpiry = false): ?array
    {
        if (!is_file($path)) {
            return null;
        }

        $cached = json_decode((string) file_get_contents($path), true);

        if (!is_array($cached) || empty($cached['otp_ref_id'])) {
            return null;
        }

        if (!$ignoreExpiry && !empty($cached['expires_at']) && time() >= (int) $cached['expires_at']) {
            return null;
        }

        return $cached;
    }

    /** @param array<string, mixed> $otp The `otp` value returned by `AuthService::requestOtp()`. */
    public static function savePendingOtp(string $path, array $otp): void
    {
        file_put_contents($path, json_encode($otp, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));
    }
}
