<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * Withdrawal (cash out to bank / agent).
 *
 * ⚠️ {@see doWithdrawal()} and {@see generateWithdrawalCode()} MOVE REAL MONEY.
 */
final class WithdrawalService
{
    private const PATH_SOURCES = 'withdrawal-service/v1/withdrawal/sources';
    private const PATH_PRESETS = 'withdrawal-service/v1/withdrawal/sources/{id}/presets';
    private const PATH_WITHDRAWAL = 'withdrawal-service/v1/withdrawal';
    private const PATH_GUIDANCE = 'voucher-service/withdrawal-step';
    private const PATH_PARTNER_CODE = 'voucher-service/v1/idm-withdrawal';

    public function __construct(private readonly Client $client)
    {
    }

    /** GET .../sources — list of funding sources / target bank accounts for withdrawal. */
    public function getWithdrawalSource(): array
    {
        return $this->client->get(self::PATH_SOURCES);
    }

    /** GET .../sources/{id}/presets — suggested amounts for a given source. */
    public function getNominalSuggestions(string $sourceId): array
    {
        return $this->client->get(str_replace('{id}', $sourceId, self::PATH_PRESETS));
    }

    /**
     * POST .../withdrawal with header `trx-id` — EXECUTE a withdrawal (moves real money).
     *
     * NOTE: `WithdrawalRequest.transactionId` is not serialized — it does NOT go in the
     * JSON body; idempotency is carried entirely by the `trx-id` header.
     *
     * @param string                    $trxId      idempotency key (header `trx-id`)
     * @param string                    $sourceId   JSON key: `source_id`
     * @param array<int, array<string, string>> $amounts
     * @param string                    $time
     * @param array<string, string>     $feeAmount  JSON key: `fee_amount`
     */
    public function doWithdrawal(string $trxId, string $sourceId, array $amounts, string $time, array $feeAmount): array
    {
        return $this->client->post(self::PATH_WITHDRAWAL, [
            'source_id' => $sourceId,
            'amounts'   => $amounts,
            'time'      => $time,
            'fee_amount' => $feeAmount,
        ], null, ['trx-id' => $trxId]);
    }

    /** GET .../withdrawal-step — partner cash-withdrawal UI guidance. */
    public function getWithdrawalGuidance(): array
    {
        return $this->client->get(self::PATH_GUIDANCE);
    }

    /**
     * POST .../idm-withdrawal with header `trxid` (NO dash) — generate a cash-out code to be
     * redeemed in person at a partner/agent (moves real money).
     *
     * @param array<string, mixed> $withdrawalPartnerRequest
     */
    public function generateWithdrawalCode(string $trxId, array $withdrawalPartnerRequest): array
    {
        return $this->client->post(self::PATH_PARTNER_CODE, $withdrawalPartnerRequest, null, ['trxid' => $trxId]);
    }

    /** DELETE .../idm-withdrawal — cancel an active partner withdrawal. */
    public function cancelWithdrawalPartner(): array
    {
        return $this->client->del(self::PATH_PARTNER_CODE);
    }

    /** DELETE <dynamic url> with body. */
    public function cancelWithdrawal(string $url, array $body): array
    {
        return $this->client->del($url, $body);
    }

    /** POST <dynamic url> — fetch a withdrawal token (from the confirmation flow). */
    public function getTokenWithdrawal(string $url, array $body): array
    {
        return $this->client->post($url, $body);
    }
}
