<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * Top-up balance (debit card). Only methods with static paths are implemented; the rest use
 * a dynamic URL from a previous response — see per-method notes.
 *
 * ⚠️ SECURITY: {@see topUpDebitPrepare()} Sends the raw CARD NUMBER + CVV + EXPIRY in the
 * JSON body. This is exactly what the official app does (the card fields are sent as
 * top-level fields), but it means any log/save of this request is equivalent to storing
 * raw card data. Do NOT log or store it.
 */
final class TopUpService
{
    private const PATH_MENU = 'v1/topup/getTopupOptions';
    private const PATH_DENOM = 'wallet/debit/denom';
    private const PATH_DEBIT_PREPARE_V21 = 'wallet/topup/debit/prepare/v2.1';
    private const PATH_DEBIT_EXECUTE = 'wallet/topup/debit/execute/v2';

    public function __construct(private readonly Client $client)
    {
    }

    /** GET /v1/topup/getTopupOptions with `userAccessToken` + `clientId` headers — top-up menu. */
    public function getTopUpMenu(string $token, string $clientId): array
    {
        return $this->client->get(self::PATH_MENU, [], [
            'userAccessToken' => $token,
            'clientId'        => $clientId,
        ]);
    }

    /** GET /wallet/debit/denom with `version` header — debit top-up denominations. */
    public function getTopupDenom(string $version): array
    {
        return $this->client->get(self::PATH_DENOM, [], ['version' => $version]);
    }

    /**
     * POST /wallet/topup/debit/prepare/v2.1 with `version` header — prepare a debit-card top-up.
     * Body `PrepareTopUpRequest` — card fields (`number`/`holder`/`cvv`/`expiredDate`) are
     * sent as top-level fields.
     *
     * @param string                    $version
     * @param string                    $merchantReference
     * @param string                    $currency
     * @param int|string                $denomId
     * @param int|string                $amount
     * @param int|string                $fee
     * @param array<string, string>     $cardCredential keys: number, holder, cvv, expiredDateString
     */
    public function topUpDebitPrepare(
        string $version,
        string $merchantReference,
        int|string $denomId,
        int|string $amount,
        int|string $fee,
        array $cardCredential,
        string $currency = 'IDR',
    ): array {
        return $this->client->post(self::PATH_DEBIT_PREPARE_V21, [
            'merchantReference' => $merchantReference,
            'currency'          => $currency,
            'denomId'           => $denomId,
            'amount'            => $amount,
            'fee'               => $fee,
            'number'            => $cardCredential['number'] ?? null,
            'holder'            => $cardCredential['holder'] ?? null,
            'cvv'               => $cardCredential['cvv'] ?? null,
            'expiredDate'       => $cardCredential['expiredDateString'] ?? null,
        ], null, ['version' => $version]);
    }

    /**
     * POST /wallet/topup/debit/execute/v2 with `version` header — execute a top-up (REAL MONEY
     * moves from the debit card into the OVO balance).
     *
     * @param string     $version
     * @param array<string, mixed> $p TopUpRequest: orderId, merchantReference, denomId, amount, fee, accountNo
     */
    public function topupDebit(string $version, array $p): array
    {
        return $this->client->post(self::PATH_DEBIT_EXECUTE, [
            'orderId'           => $p['orderId'] ?? null,
            'merchantReference' => $p['merchantReference'] ?? null,
            'denomId'           => $p['denomId'] ?? null,
            'amount'            => $p['amount'] ?? null,
            'fee'               => $p['fee'] ?? null,
            'accountNo'         => $p['accountNo'] ?? null,
        ], null, ['version' => $version]);
    }

    /** POST <dynamic url> — instant top-up inquiry. */
    public function getInstantTopUpPaymentInquiry(string $url, array $request): array
    {
        return $this->client->post($url, $request);
    }
}
