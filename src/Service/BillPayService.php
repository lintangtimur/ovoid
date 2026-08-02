<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * Bill payment (PLN, PDAM, BPJS, voucher, etc.).
 *
 * Nearly every method uses a dynamic URL — there is NO static path; the path always comes
 * from a previous endpoint's response (e.g. `getCategories()` returns links used by
 * `getBillersByCategory()`, and so on). `"billpayment/v1/categories"` in
 * {@see getCategories()} is a guessed entry point — the real one may come from remote
 * config rather than a hardcode.
 */
final class BillPayService
{
    private const DEFAULT_CATEGORIES_URL = 'billpayment/v1/categories';

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * @param string               $categoryId
     * @param string|null          $level
     * @param string|int|null      $limit
     * @param string|int|null      $offset
     * @param string|null          $keyword
     * @param string               $url
     */
    public function getCategories(string $categoryId, ?string $level = null, string|int|null $limit = null, string|int|null $offset = null, ?string $keyword = null, string $url = self::DEFAULT_CATEGORIES_URL): array
    {
        return $this->client->get($url, array_filter([
            'categoryID' => $categoryId,
            'level'      => $level,
            'limit'      => $limit,
            'offset'     => $offset,
            'keyword'    => $keyword,
        ], static fn ($v) => $v !== null));
    }

    public function getBillersByCategory(string $fullPath, string $categoryId): array
    {
        return $this->client->get($fullPath, ['categoryID' => $categoryId]);
    }

    public function getBillerDenominations(string $fullPath, ?string $limit = null, ?string $offset = null): array
    {
        return $this->client->get($fullPath, array_filter([
            'limit'  => $limit,
            'offset' => $offset,
        ], static fn ($v) => $v !== null));
    }

    public function getBillerInfo(string $fullPath): array
    {
        return $this->client->get($fullPath);
    }

    public function getRecents(string $fullPath): array
    {
        return $this->client->get($fullPath);
    }

    public function getListFavorites(string $fullPath): array
    {
        return $this->client->get($fullPath);
    }

    /** @param array<string, mixed> $billerFormRequest */
    public function getFormComponent(string $url, array $billerFormRequest): array
    {
        return $this->client->post($url, $billerFormRequest);
    }

    /**
     * @param array<string, mixed>     $param
     * @param array<string, mixed>|null $body
     */
    public function getFormInquiry(string $url, bool $isFavorite, array $body): array
    {
        return $this->client->post($url, $body, ['isFavorite' => $isFavorite]);
    }

    /** @param array<string, mixed> $inquiryRequest */
    public function inquiry(string $fullPath, array $inquiryRequest): array
    {
        return $this->client->post($fullPath, $inquiryRequest);
    }

    /** @param array<string, mixed> $payRequest */
    public function payBill(string $url, string $trxId, array $payRequest): array
    {
        return $this->client->post($url, $payRequest, null, ['trxId' => $trxId]);
    }

    /** @param array<string, mixed> $orderStatusRequest */
    public function checkOrderStatusPending(string $url, array $orderStatusRequest): array
    {
        return $this->client->post($url, $orderStatusRequest);
    }

    /** @param array<string, mixed> $userProfilingRequest */
    public function editFavorite(string $url, array $userProfilingRequest): array
    {
        return $this->client->put($url, $userProfilingRequest);
    }

    public function deleteFavorite(string $url): array
    {
        return $this->client->del($url);
    }
}
