<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/** Wallet balance inquiry. */
final class BalanceService
{
    private const PATH_INQUIRY = 'wallet/inquiry';

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * NOTE: this endpoint uses the OLDER `{status, data, message}` envelope, not the
     * `{response_code, response_message, data}` shape used elsewhere — {@see Client}
     * only unwraps the latter, so read `['data']['001']` / `['data']['600']` yourself
     * (OVO Cash and OVO Points respectively).
     */
    public function inquiryBalance(): array
    {
        return $this->client->get(self::PATH_INQUIRY);
    }
}
