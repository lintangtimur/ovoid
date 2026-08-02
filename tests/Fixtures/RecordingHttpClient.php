<?php

declare(strict_types=1);

namespace Stelin\Tests\Fixtures;

use Stelin\Http\HttpClientInterface;

/** Test double that returns a canned response and records the last request it received. */
final class RecordingHttpClient implements HttpClientInterface
{
    public ?string $lastMethod = null;
    public ?string $lastUrl = null;
    public ?string $lastBody = null;
    /** @var array<string, string>|null */
    public ?array $lastHeaders = null;

    public function __construct(private readonly int $status, private readonly string $body)
    {
    }

    public function request(string $method, string $url, ?string $body, array $headers): array
    {
        $this->lastMethod = $method;
        $this->lastUrl = $url;
        $this->lastBody = $body;
        $this->lastHeaders = $headers;

        return ['status' => $this->status, 'body' => $this->body];
    }
}
