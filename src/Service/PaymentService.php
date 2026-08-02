<?php

declare(strict_types=1);

namespace Stelin\Service;

use RuntimeException;
use Stelin\Client;
use Stelin\Config;
use Stelin\Crypto;

/**
 * Legacy payment APIs.
 * Bodies are NOT encrypted (TLS only), except the QR payment which carries `signature`/`time`
 * headers — but the exact algorithm of those headers is not yet well-known, so treat
 * {@see doQrPayment()} as a structurally-correct scaffold the server may reject until the
 * signature is verified at runtime.
 */
final class PaymentService
{
    private const PATH_QR_PAYMENT = 'wallet/purchase/qr';
    private const PATH_PAYMENT_METHOD = 'wallet/payment-method/';
    private const PATH_PAYMENT_METHOD_MERCHANT = 'wallet/payment-method/merchant/';
    private const PATH_ORDER_EXPIRY = 'wallet/order/';
    private const PATH_TIP = 'v1.0/reference/master/amounts';
    private const PATH_SEND_PAYMENT = 'wallet/payment/v2';

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * POST /wallet/purchase/qr — QR payment.
     * Headers `app-id: ovo-apps`, `signature` + `time`. The header names are known, but the
     * value/algorithm of `signature` is not yet well-known.
     *
     * @param array<string, mixed>             $bodyRequest  QrPaymentRequest: amount, merchantId, invoice, ...
     * @param string                           $clientSecret required for the signature (see Crypto note)
     * @param string|null                      $timestamp
     */
    public function doQrPayment(array $bodyRequest, string $clientSecret, ?string $timestamp = null): array
    {
        if ($clientSecret === '') {
            throw new RuntimeException('clientSecret is required for the QR payment signature.');
        }

        [$signature, $time] = Crypto::signQrPayment($bodyRequest, $clientSecret, $timestamp);

        return $this->client->post(self::PATH_QR_PAYMENT, $bodyRequest, null, [
            'app-id'    => 'ovo-apps',
            'signature' => $signature,
            'time'      => $time,
        ]);
    }

    /**
     * POST <dynamic url> — cap point (OVO Points cap check). The
     * `url` usually comes from another endpoint's response. Sends headers `app-id` and `service`.
     *
     * @param array<string, mixed> $request
     */
    public function getCapPoint(string $url, string $appId, string $service, array $request): array
    {
        return $this->client->post($url, $request, null, ['app-id' => $appId, 'service' => $service]);
    }

    /** GET /wallet/payment-method/ */
    public function getPaymentMethod(): array
    {
        return $this->client->get(self::PATH_PAYMENT_METHOD);
    }

    /** GET /wallet/payment-method/merchant/{id} */
    public function getPaymentMethodByMerchant(string $merchantId): array
    {
        return $this->client->get(self::PATH_PAYMENT_METHOD_MERCHANT . $merchantId);
    }

    /** GET /wallet/payment-method/merchant/{id}/deals/{deal_id} */
    public function getPaymentMethodByMerchantDeal(string $merchantId, string $dealId): array
    {
        return $this->client->get(self::PATH_PAYMENT_METHOD_MERCHANT . $merchantId . '/deals/' . $dealId);
    }

    /** GET /wallet/order/{orderID}/expiry — remaining order time. */
    public function getRemainingTimeout(string $orderId): array
    {
        return $this->client->get(self::PATH_ORDER_EXPIRY . $orderId . '/expiry');
    }

    /** POST /v1.0/reference/master/amounts — suggested tip, with `clientId` header. */
    public function getTip(string $clientId, array $request): array
    {
        return $this->client->post(self::PATH_TIP, $request, null, ['clientId' => $clientId]);
    }

    /**
     * POST /wallet/payment/v2 (form-encoded) — sendPayment.
     * Sends an already-encoded form string, not JSON.
     *
     * @param array<string, string|int|null> $f field map — see method body for fields
     */
    public function sendPayment(array $f, string $isoDate): array
    {
        $fields = [
            'merchant_id'        => $f['merchantId'] ?? null,
            'card_type1'         => $f['cardType'] ?? null,
            'appsource'          => Config::APP_SOURCE,
            'transaction_amount' => $f['transactionAmount'] ?? null,
            'card_amount1'       => $f['cardAmount'] ?? null,
            'transaction_id'     => $f['transactionId'] ?? null,
            'merchant_invoice'   => $f['merchantInvoice'] ?? null,
            'card_amount2'       => $f['cardAmountExt'] ?? null,
            'card_type2'         => $f['cardTypeExt'] ?? null,
        ];
        $parts = [];
        foreach ($fields as $key => $value) {
            if ($value !== null && $value !== '') {
                $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
            }
        }
        $form = implode('&', $parts);

        return $this->client->post(self::PATH_SEND_PAYMENT, $form, null, [
            'Content-Type'   => 'application/x-www-form-urlencoded',
            'transaction-id' => Crypto::uuidV4(),
            'date_time'      => $isoDate,
        ]);
    }
}
