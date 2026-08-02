<?php

declare(strict_types=1);

namespace Stelin\Http;

/**
 * Minimal HTTP transport abstraction. Injected into {@see \Stelin\Client}, so tests can
 * substitute a fake implementation instead of hitting the network.
 */
interface HttpClientInterface
{
    /**
     * @param array<string, string> $headers
     * @return array{status: int, body: string}
     */
    public function request(string $method, string $url, ?string $body, array $headers): array;
}
