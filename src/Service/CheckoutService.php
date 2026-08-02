<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;

/**
 * Checkout (OVO merchant checkout).
 * Every method uses a dynamic URL (no static path), and {@see doCheckout()} sends its
 * idempotency key as the `trx-id` header.
 */
final class CheckoutService
{
    public function __construct(private readonly Client $client)
    {
    }

    /**
     * POST <dynamic url> with header `trx-id` — perform checkout.
     *
     * @param string               $url            dynamic URL from a previous response
     * @param string               $trxId          idempotency key, sent as header `trx-id`
     * @param array<string, mixed> $checkoutRequest CheckoutRequest body
     */
    public function doCheckout(string $url, string $trxId, array $checkoutRequest): array
    {
        return $this->client->post($url, $checkoutRequest, null, ['trx-id' => $trxId]);
    }

    /** POST <dynamic url> — fetch checkout details. */
    public function getCheckoutDetail(string $url, array $checkoutDetailRequest): array
    {
        return $this->client->post($url, $checkoutDetailRequest);
    }

    /** POST <dynamic url> — fetch available promos. */
    public function getPromos(string $url, array $requestMap): array
    {
        return $this->client->post($url, $requestMap);
    }

    /** POST <dynamic url> — remove an applied promo. */
    public function cancelPromo(string $url, array $request): array
    {
        return $this->client->post($url, $request);
    }
}
