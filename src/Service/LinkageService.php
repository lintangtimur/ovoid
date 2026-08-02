<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * Linkage (OAuth partner — e.g. a linked OVO/Grab account).
 * Some methods take an explicit `Authorization` header and a `clientIdentifier` query,
 * in addition to the headers the client injects automatically.
 */
final class LinkageService
{
    private const PATH_LINKAGES = 'user/v5/api/oauth/linkages';
    private const PATH_TNC_CONTENT = 'system/v5/api/oauth/tnc/content';
    private const PATH_TNC_ACCEPT = 'user/v5/api/oauth/tnc/accept';
    private const PATH_INTENT = 'user/v5/api/oauth/intent';
    private const PATH_VERIFY_CODE = 'user/v5/api/oauth/securityCode/verify';
    private const PATH_UNLINK = 'user/v5/api/oauth/unlink';

    public function __construct(private readonly Client $client)
    {
    }

    public function getAllLinkages(): array
    {
        return $this->client->get(self::PATH_LINKAGES);
    }

    /** @param array<string, string|scalar>|null $headers */
    public function getTnc(string $authHeader, string $clientIdentifier, ?array $headers = null): array
    {
        $h = ['Authorization' => $authHeader] + ($headers ?? []);

        return $this->client->get(self::PATH_TNC_CONTENT, ['clientIdentifier' => $clientIdentifier], $h);
    }

    /** @param array<string, mixed>                 $acceptTncConsentRequest
     *  @param array<string, string|scalar>|null    $headers
     */
    public function acceptTnc(string $authHeader, string $clientIdentifier, array $acceptTncConsentRequest, ?array $headers = null): array
    {
        $h = ['Authorization' => $authHeader] + ($headers ?? []);

        return $this->client->post(self::PATH_TNC_ACCEPT, $acceptTncConsentRequest, ['clientIdentifier' => $clientIdentifier], $h);
    }

    /** @param array<string, mixed> $initiateLinkageRequest */
    public function initiateLinkage(array $initiateLinkageRequest): array
    {
        return $this->client->post(self::PATH_INTENT, $initiateLinkageRequest);
    }

    /** @param array<string, mixed>                 $linkAccountRequest
     *  @param array<string, string|scalar>|null    $headers
     */
    public function linkPartnerAccount(string $authHeader, array $linkAccountRequest, ?array $headers = null): array
    {
        $h = ['Authorization' => $authHeader] + ($headers ?? []);

        return $this->client->post(self::PATH_VERIFY_CODE, $linkAccountRequest, null, $h);
    }

    /** @param array<string, mixed> $unlinkAccountRequest */
    public function unlinkAccount(array $unlinkAccountRequest): array
    {
        return $this->client->post(self::PATH_UNLINK, $unlinkAccountRequest);
    }
}
