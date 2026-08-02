<?php

declare(strict_types=1);

namespace Stelin;

use JsonException;
use Stelin\Exception\ApiException;
use Stelin\Http\CurlHttpClient;
use Stelin\Http\HttpClientInterface;

/**
 * Low-level HTTP client shared by every {@see Service} class.
 *
 * Injects the headers the mobile OVO app sends, and unwraps the
 * `{response_code, response_version, response_message, data}` envelope.
 *
 * A handful of older endpoints (e.g. `wallet/inquiry`) use a different, legacy
 * `{status, data, message}` envelope instead. Those don't match the unwrap condition
 * below, so they're returned to the caller unmodified — read `['data']` yourself.
 *
 * Endpoints share one base URL but often need a per-call header (e.g. an idempotency
 * `trx-id`, a `version`, or an `Authorization` explicit override). Those are passed via
 * the optional `$headers` argument on `get`/`post`/`put`/`del`/`request`; they merge on
 * top of (and override) the defaults. A raw `$body` string (e.g. an already-encoded form
 * body) is sent verbatim instead of being JSON-encoded.
 */
final class Client
{
    private ?string $accessToken = null;

    public function __construct(
        private readonly string $deviceId,
        private readonly HttpClientInterface $http = new CurlHttpClient(),
        private readonly string $baseUrl = Config::BASE_URL,
    ) {
    }

    public function setAccessToken(?string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param array<string, scalar>            $query
     * @param array<string, string|scalar>|null $headers
     * @return array<mixed>
     */
    public function get(string $path, array $query = [], ?array $headers = null): array
    {
        return $this->request('GET', $path, null, $query, $headers);
    }

    /**
     * @param array<string, mixed>|string|null $body   array is JSON-encoded, string is sent verbatim
     * @param array<string, string|scalar>|null $headers
     * @return array<mixed>
     */
    public function post(string $path, array|string|null $body = null, ?array $query = null, ?array $headers = null): array
    {
        return $this->request('POST', $path, $body, $query, $headers);
    }

    /**
     * @param array<string, mixed>|string|null $body
     * @param array<string, string|scalar>|null $headers
     * @return array<mixed>
     */
    public function put(string $path, array|string|null $body = null, ?array $query = null, ?array $headers = null): array
    {
        return $this->request('PUT', $path, $body, $query, $headers);
    }

    /**
     * DELETE — optionally with a body, used by a few dynamic-URL endpoints.
     *
     * @param array<string, mixed>|string|null $body
     * @param array<string, string|scalar>|null $headers
     * @return array<mixed>
     */
    public function del(string $path, array|string|null $body = null, ?array $query = null, ?array $headers = null): array
    {
        return $this->request('DELETE', $path, $body, $query, $headers);
    }

    /**
     * Generic request entry point.
     *
     * @param string                              $method  GET|POST|PUT|DELETE
     * @param string                              $path    absolute URL or path relative to baseUrl
     * @param array<string, mixed>|string|null    $body    array -> JSON; string -> sent verbatim
     * @param array<string, scalar>|null          $query
     * @param array<string, string|scalar>|null   $headers extra headers to merge on defaults
     * @return array<mixed>
     */
    public function request(string $method, string $path, array|string|null $body = null, ?array $query = null, ?array $headers = null): array
    {
        $url = $this->buildUrl($path, $query ?? []);
        $headers = $this->headers($headers);
        $jsonBody = $this->encodeBody($body);

        $response = $this->http->request($method, $url, $jsonBody, $headers);
        $payload = $this->decodeJson($response['body']);

        if ($response['status'] < 200 || $response['status'] >= 300) {
            throw new ApiException(
                $payload['response_message'] ?? $payload['message'] ?? "HTTP {$response['status']}",
                $payload['response_code'] ?? null,
                $payload,
                $response['status'],
            );
        }

        if (array_key_exists('response_code', $payload) && array_key_exists('data', $payload)) {
            return $payload['data'] ?? [];
        }

        return $payload;
    }

    /**
     * Merge per-request headers with the defaults sent for every request.
     *
     * @param array<string, string|scalar>|null $extra
     * @return array<string, string>
     */
    private function headers(?array $extra = null): array
    {
        $headers = [
            'OS'           => Config::OS,
            'OS-Version'   => Config::OS_VERSION,
            'App-Version'  => Config::APP_VERSION,
            'client-id'    => Config::CLIENT_ID,
            'device-id'    => $this->deviceId,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'User-Agent'   => Config::USER_AGENT,
        ];

        if ($this->accessToken !== null && $this->accessToken !== '') {
            $headers['Authorization'] = "Bearer {$this->accessToken}";
        }

        if ($extra !== null) {
            foreach ($extra as $name => $value) {
                $headers[$name] = (string) $value;
            }
        }

        return $headers;
    }

    /** @param array<string, scalar> $query */
    private function buildUrl(string $path, array $query): string
    {
        $url = str_starts_with($path, 'http') ? $path : $this->baseUrl . ltrim($path, '/');

        if ($query !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
        }

        return $url;
    }

    /**
     * @param array<string, mixed>|string|null $body
     */
    private function encodeBody(array|string|null $body): ?string
    {
        if ($body === null) {
            return null;
        }

        if (is_string($body)) {
            return $body;
        }

        try {
            return json_encode($body, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ApiException("Failed to encode request body: {$e->getMessage()}", null, [], 0);
        }
    }

    /** @return array<mixed> */
    private function decodeJson(string $body): array
    {
        if ($body === '') {
            return [];
        }

        try {
            $decoded = json_decode($body, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return [];
        }

        return is_array($decoded) ? $decoded : [];
    }
}
