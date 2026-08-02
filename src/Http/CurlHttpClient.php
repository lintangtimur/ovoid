<?php

declare(strict_types=1);

namespace Stelin\Http;

use RuntimeException;

/**
 * Zero-dependency {@see HttpClientInterface} implementation backed by ext-curl — matches
 * the original spirit of this package (no Guzzle/PSR-18 required just to send JSON).
 */
final class CurlHttpClient implements HttpClientInterface
{
    public function __construct(private readonly int $timeoutSeconds = 30)
    {
    }

    public function request(string $method, string $url, ?string $body, array $headers): array
    {
        $handle = curl_init($url);

        $headerLines = [];
        foreach ($headers as $name => $value) {
            $headerLines[] = "{$name}: {$value}";
        }

        curl_setopt_array($handle, [
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_HTTPHEADER     => $headerLines,
            CURLOPT_POSTFIELDS     => $body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => $this->timeoutSeconds,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $responseBody = curl_exec($handle);

        if ($responseBody === false) {
            $error = curl_error($handle);
            curl_close($handle);

            throw new RuntimeException("HTTP request to {$url} failed: {$error}");
        }

        $status = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        return ['status' => $status, 'body' => (string) $responseBody];
    }
}
