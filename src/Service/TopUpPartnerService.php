<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * Top-up via voucher / agent (retail/CIM).
 */
final class TopUpPartnerService
{
    private const PATH_STORE_DETAILS = 'cim/v1/merchants/{merchant_id}';
    private const PATH_GENERATE_CODE = 'voucher-service/topup/generate';
    private const PATH_PAYMENT_CODE_SCREEN = 'voucher-service/topup/voucherScreen';

    public function __construct(private readonly Client $client)
    {
    }

    /** GET /cim/v1/merchants/{merchant_id}?txnAmount=... — store/agent details for a top-up. */
    public function getStoreDetails(string $merchantId, int|string $txnAmount): array
    {
        return $this->client->get(
            str_replace('{merchant_id}', $merchantId, self::PATH_STORE_DETAILS),
            ['txnAmount' => $txnAmount],
        );
    }

    /** POST /voucher-service/topup/generate — generate a top-up voucher code (moves real money). */
    public function generateTopUpPaymentCode(array $generateVoucherCodeRequest): array
    {
        return $this->client->post(self::PATH_GENERATE_CODE, $generateVoucherCodeRequest);
    }

    /** POST /voucher-service/topup/voucherScreen — payment-code screen data for a top-up. */
    public function getTopUpPaymentCode(array $request): array
    {
        return $this->client->post(self::PATH_PAYMENT_CODE_SCREEN, $request);
    }

    /** DELETE <dynamic url> with body — cancel a top-up partner transaction. */
    public function cancelTopUpPartner(string $url, array $body): array
    {
        return $this->client->del($url, $body);
    }
}
