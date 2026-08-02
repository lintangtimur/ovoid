<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * Transaction history & detail. All read-only.
 */
final class HistoryService
{
    private const PATH_TRANSACTION_LIST = 'payment/orders/v1/list';
    private const PATH_NABUNG_LIST = 'payment/orders/v1/nabung-list';

    public function __construct(private readonly Client $client)
    {
    }

    /** GET /payment/orders/v1/list — main wallet transaction history. */
    public function getTransactionHistory(int $page, int $limit, string $productType = ''): array
    {
        return $this->client->get(self::PATH_TRANSACTION_LIST, [
            'page' => $page,
            'limit' => $limit,
            'productType' => $productType,
        ]);
    }

    /** GET /payment/orders/v1/nabung-list — OVO Nabung (savings) history. */
    public function getTabunganHistory(int $page, int $limit, string $productType = ''): array
    {
        return $this->client->get(self::PATH_NABUNG_LIST, [
            'page' => $page,
            'limit' => $limit,
            'productType' => $productType,
        ]);
    }

    /** GET <dynamic url> — PayLater history. No static path. */
    public function getPayLaterHistory(string $url, int $page, int $limit): array
    {
        return $this->client->get($url, ['page' => $page, 'limit' => $limit]);
    }

    /** GET <dynamic url> — recent bill-payment transactions. No static path. */
    public function getRecentTransactions(string $url, string $categoryId, ?string $billerId = null, ?string $productId = null): array
    {
        return $this->client->get($url, array_filter([
            'categoryId' => $categoryId,
            'billerId' => $billerId,
            'productId' => $productId,
        ], static fn ($v) => $v !== null));
    }

    /** DELETE <dynamic url> — remove an entry from recent bill-payment transactions. */
    public function deleteRecentTransaction(string $url): array
    {
        return $this->client->del($url);
    }

    public function getTransactionDetail(string $merchantId, string $merchantInvoice): array
    {
        return $this->client->get("wallet/transaction/{$merchantId}/{$merchantInvoice}");
    }

    /** POST <dynamic url> — full receipt content. Generic body map. */
    public function getReceiptContent(string $url, array $request): array
    {
        return $this->client->post($url, $request);
    }

    /** POST <dynamic url> — mark a merchant as favorite from a receipt. */
    public function addFavoriteFromReceipt(string $url, array $request): array
    {
        return $this->client->post($url, $request);
    }
}
