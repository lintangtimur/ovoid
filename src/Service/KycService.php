<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * KYC upgrade.
 */
final class KycService
{
    private const PATH_CUSTOMER_UPGRADE_STATUS = 'v4/kyc/customer/status';
    private const PATH_EKYC_CHECK = 'emoneyKyc/v1.0/user/ekyc/check';

    public function __construct(private readonly Client $client)
    {
    }

    /** GET v4/kyc/customer/status — current customer KYC upgrade status. */
    public function getCustomerUpgradeStatus(): array
    {
        return $this->client->get(self::PATH_CUSTOMER_UPGRADE_STATUS);
    }

    /** GET /emoneyKyc/v1.0/user/ekyc/check — eKYC eligibility/state. */
    public function getKycStatus(): array
    {
        return $this->client->get(self::PATH_EKYC_CHECK);
    }
}
