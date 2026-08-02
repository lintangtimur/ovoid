<?php

declare(strict_types=1);

namespace Stelin\Exception;

/**
 * Thrown when OVO's API responds with an error envelope, e.g.
 * `{"response_code":"OV00013","response_message":"Anda Tidak Memiliki Akses"}`.
 *
 * The standard envelope is `{response_code, response_version, response_message, data}`.
 * Some legacy endpoints (e.g. `wallet/inquiry`) use an older `{status, data, message}`
 * shape instead; {@see \Stelin\Client} only throws this exception for a non-2xx HTTP
 * status, so check {@see self::$responseCode} for the machine-readable OVO error code
 * either way.
 */
final class ApiException extends OvoidException
{
    /** @param array<mixed> $payload Full decoded JSON response body. */
    public function __construct(
        string $message,
        public readonly ?string $responseCode,
        public readonly array $payload,
        public readonly int $httpStatus,
    ) {
        parent::__construct($message);
    }
}
