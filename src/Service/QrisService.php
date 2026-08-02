<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * QR scan & checkout-data.
 *
 * Both endpoints are static and take their parameters via query string (not a request body).
 */
final class QrisService
{
    private const PATH_QR_SCAN = 'v1/payx/qr/scan';
    private const PATH_QR_CHECKOUT = 'v1/payx/qr/checkout';

    public function __construct(private readonly Client $client)
    {
    }

    /** GET /v1/payx/qr/scan?qrid=... — decode a freshly scanned QR. */
    public function qrScanPay(string $qrid): array
    {
        return $this->client->get(self::PATH_QR_SCAN, ['qrid' => $qrid]);
    }

    /** GET /v1/payx/qr/checkout?scanid=...&amount=... — build checkout data from the scan result. */
    public function generateCheckoutData(string $scanId, string|int|float $amount): array
    {
        return $this->client->get(self::PATH_QR_CHECKOUT, [
            'scanid' => $scanId,
            'amount' => (string) $amount,
        ]);
    }
}
