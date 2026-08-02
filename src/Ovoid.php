<?php

declare(strict_types=1);

namespace Stelin;

use Stelin\Http\CurlHttpClient;
use Stelin\Http\HttpClientInterface;
use Stelin\Service\AuthService;
use Stelin\Service\BalanceService;
use Stelin\Service\BillPayService;
use Stelin\Service\CheckoutService;
use Stelin\Service\HistoryService;
use Stelin\Service\KycService;
use Stelin\Service\LinkageService;
use Stelin\Service\PaymentService;
use Stelin\Service\QrisService;
use Stelin\Service\SecurityService;
use Stelin\Service\TopUpPartnerService;
use Stelin\Service\TopUpService;
use Stelin\Service\TransferService;
use Stelin\Service\WithdrawalService;

/**
 * Unofficial OVO (`ovo.id`) API client. Combines every service behind one instance.
 *
 * @example
 *   $ovo = new OVOID(deviceId: 'my-device-id');
 *
 *   $otp = $ovo->auth->requestOtp('+62812xxxxxxx', 'my-device-id');
 *   $code = '123456'; // user reads the SMS/link code
 *   $validated = $ovo->auth->validateOtp(
 *       '+62812xxxxxxx', 'my-device-id', $code,
 *       $otp['otp']['otp_ref_id'], $otp['otp']['type'],
 *   );
 *   $login = $ovo->auth->loginWithPin(
 *       '+62812xxxxxxx', $pin, 'my-device-id',
 *       $validated['otp']['otp_token'], $validated['otp']['otp_ref_id'],
 *   );
 *
 *   $ovo->client->setAccessToken($login['auth']['access_token']);
 *   $balance = $ovo->balance->inquiryBalance();
 */
final class OVOID
{
    public readonly Client $client;
    public readonly AuthService $auth;
    public readonly BalanceService $balance;
    public readonly HistoryService $history;
    public readonly TransferService $transfer;
    public readonly PaymentService $payment;
    public readonly QrisService $qris;
    public readonly CheckoutService $checkout;
    public readonly BillPayService $billpay;
    public readonly LinkageService $linkage;
    public readonly KycService $kyc;
    public readonly WithdrawalService $withdrawal;
    public readonly TopUpService $topup;
    public readonly TopUpPartnerService $topupPartner;
    public readonly SecurityService $security;

    public function __construct(string $deviceId, ?HttpClientInterface $httpClient = null)
    {
        $this->client = new Client($deviceId, $httpClient ?? new CurlHttpClient());
        $this->auth = new AuthService($this->client);
        $this->balance = new BalanceService($this->client);
        $this->history = new HistoryService($this->client);
        $this->transfer = new TransferService($this->client);
        $this->payment = new PaymentService($this->client);
        $this->qris = new QrisService($this->client);
        $this->checkout = new CheckoutService($this->client);
        $this->billpay = new BillPayService($this->client);
        $this->linkage = new LinkageService($this->client);
        $this->kyc = new KycService($this->client);
        $this->withdrawal = new WithdrawalService($this->client);
        $this->topup = new TopUpService($this->client);
        $this->topupPartner = new TopUpPartnerService($this->client);
        $this->security = new SecurityService($this->client);
    }
}
