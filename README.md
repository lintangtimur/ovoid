<p align="center">
<a href="https://packagist.org/packages/lintangtimur/ovoid"><img src="https://img.shields.io/packagist/v/lintangtimur/ovoid.svg?style=popout-square"></a>
<a href="https://github.com/lintangtimur/ovoid/blob/master/LICENSE"><img src="https://img.shields.io/github/license/lintangtimur/ovoid.svg?style=popout-square"></a>
<img alt="Packagist" src="https://img.shields.io/packagist/dt/lintangtimur/ovoid?style=flat-square">
</p>

<h2 align="center">ovoid — Unofficial OVO API client for PHP</h2>

A lightweight, zero-dependency PHP client for the OVO (`ovo.id`) mobile wallet API. It mirrors
the request/response shapes the official app uses, so the endpoints behave the same way you'd
see in the app.

> Research/educational use only. Not affiliated with OVO. This library does not bypass any
> protection  it still needs real OTP/PIN credentials for the account it is used with, and
> it cannot reproduce the hardware-bound ECDSA signature used by OVO's Digibank feature.

## Requirements

- PHP 8.1+
- `ext-curl`, `ext-openssl`
- No other dependencies

```bash
composer require lintangtimur/ovoid
```

## Quick start — login

OVO's login always requires a validated OTP, even for accounts that already have a PIN set.
The flow is: **request OTP → validate the code → login with PIN** (PIN is RSA-encrypted
automatically before it leaves your machine).

```php
use Stelin\OVOID;

$deviceId = 'any-stable-string-you-generate-once';
$ovo = new OVOID($deviceId);

// 1) Request a code. The server sends either:
//      - SMS with a 6-digit code, or
//      - a magic link (WhatsApp/email) whose URL carries the code in its `?code=` query param.
$otp = $ovo->auth->requestOtp('+62812xxxxxxx', $deviceId)['otp'];
$otpRefId = $otp['otp_ref_id'];
$otpType  = $otp['type']; // MUST be echoed back in validateOtp() — see below

// 2) Validate whatever the user received (the 6-digit SMS code, OR the `code` value from the link).
$validated = $ovo->auth->validateOtp('+62812xxxxxxx', $deviceId, $code, $otpRefId, $otpType);

// 3) Log in. `otp_token` and `otp_ref_id` come from validateOtp().
$login = $ovo->auth->loginWithPin(
    '+62812xxxxxxx',
    $pin,
    $deviceId,
    $validated['otp']['otp_token'],
    $validated['otp']['otp_ref_id'],
);

// 4) Use the access token for everything else.
$ovo->client->setAccessToken($login['auth']['access_token']);
$balance = $ovo->balance->inquiryBalance();
```

> **Two delivery channels, one validation call.** The server decides which channel to use; it
> is reported by `requestOtp()` (and `resolveOnboardingType()`) via `otp.reff_type`:
> `"OTP"` = SMS code, `"LINK"` = magic link. Both are validated with the same
> `validateOtp()` — you only change what you pass as the `$code`.

> **Echo `type` back into `validateOtp()`.** The server rejects the call with
> `OV00002 "type: non zero value required"` when `$type` is empty, so always pass through the
> `type` returned by `requestOtp()` (values seen: `LOGIN`, `CREATION`, ...). Same for
> `loginWithPin()`: `push_notification_id` must be non-empty (the wrapper falls back to
> `device_id` for you).

`resolveOnboardingType()` is **optional** — it mirrors the app's phone-number dispatch so you
can peek at the account's channel *before* requesting a code:

```php
$onboarding = $ovo->auth->resolveOnboardingType('+62812xxxxxxx', $deviceId);
// $onboarding['next'] === 'PIN_ENTRY' | 'OTP_VERIFY' | 'MAGIC_LINK' | 'UNKNOWN'
```

You do **not** need it to log in: the `requestOtp → validateOtp → loginWithPin` sequence above
is sufficient. Note that for some accounts the `onboardingType` endpoint returns `OV00013`
("Anda Tidak Memiliki Akses"); that's a red herring for login — this library does not depend on
it as a prerequisite.

## Feature examples

Everything below assumes you already have a session (see "Quick start — login"):

```php
use Stelin\OVOID;

$ovo = new OVOID($deviceId);
$ovo->client->setAccessToken($accessToken); // from $login['auth']['access_token']
```

### Balance

```php
$balance = $ovo->balance->inquiryBalance();

// `wallet/inquiry` uses the OLDER `{status, data, message}` envelope, so read `['data']` yourself.
$data = $balance['data'] ?? [];
// OVO Cash ('001'), OVO Points ('600'), ... keyed by payment-method id:
$ovoCash   = $data['001']['card_balance'] ?? null;
$ovoPoints = $data['600']['card_balance'] ?? null;
echo "OVO Cash: {$ovoCash}, OVO Points: {$ovoPoints}";
```

### History

```php
$history = $ovo->history->getTransactionHistory(1, 10);            // page 1, limit 10
$detail  = $ovo->history->getTransactionDetail($merchantId, $merchantInvoice);
```

### Transfer (read-only first)

```php
// Always check validity/fees before executing anything:
$bankList = $ovo->transfer->getBankList();
$inquiry  = $ovo->transfer->inquiryTransfer($accountNo, $bankCode, $bankName, '50000', 'message');
$isOvo    = $ovo->transfer->verifyCustomerIsOvo($mobileNumber, '50000', 'message');
```

### Transfer (moves money)

```php
// EXECUTES a real transfer. Throws AmountException if below the 10,000 minimum.
$ovo->transfer->transferBankDirect(
    $accountName, $accountNo, $accountNoDestination, '50000', $bankCode, $bankName);
$ovo->transfer->transferP2p('50000', $targetOvoMsisdn, $trxId);
```

> ⚠️ The `transferBankDirect()` / `transferP2p()` methods move real money. Always call the
> read-only `inquiryTransfer()` / `verifyCustomerIsOvo()` first, and test against your own
> account.

### Registration (new OVO account)

```php
// Same shape as loginWithPin(), but type "CREATE" and optional full name.
$register = $ovo->auth->registerWithPin(
    $msisdn, $pin, $deviceId,
    $validated['otp']['otp_token'], $validated['otp']['otp_ref_id'],
    fullName: 'Nama Pemilik',           // optional
);
```

## Caching the session token

Logging in needs a fresh OTP each time, so you can cache the session to skip it while the
token is still valid (~24 hours):

```php
use Stelin\TokenCache;

$auth = TokenCache::load(__DIR__ . '/.ovo-token.json');
if ($auth === null) {
    // ...OTP + loginWithPin() as above...
    TokenCache::save(__DIR__ . '/.ovo-token.json', $login['auth']);
    $auth = $login['auth'];
}
$ovo->client->setAccessToken($auth['access_token']);
```

> `TokenCache` compares `expires_in` against the current time as an **absolute epoch
> timestamp** (not as a duration) — see its PHPDoc for why.

`TokenCache::loadPendingOtp()` / `savePendingOtp()` do the same for an in-flight OTP request:
if `requestOtp()` hits the cooldown (`OV00015`) on a retry, the *previous* `otp_ref_id` — and
the SMS it already sent — are usually still valid. Save it after a successful `requestOtp()`
and fall back to it on cooldown instead of giving up:

```php
try {
    $otp = $ovo->auth->requestOtp($msisdn, $deviceId)['otp'];
    TokenCache::savePendingOtp(__DIR__ . '/.ovo-otp-pending.json', $otp);
} catch (ApiException $e) {
    $otp = TokenCache::loadPendingOtp(__DIR__ . '/.ovo-otp-pending.json', ignoreExpiry: true)
        ?? throw $e; // nothing to fall back to
}
```

## Services

Everything is exposed on one `OVOID` instance:

| Service | Methods | Effect |
|---|---|---|
| `$ovo->auth` | `requestOtp()`, `validateOtp()`, `resolveOnboardingType()`, `loginWithPin()`, `registerWithPin()`, `stepUpInitiate()`, `verifyPin()`, `verifyOtp()`, `resendOtp()` | login / OTP / register / RBA step-up |
| `$ovo->balance` | `inquiryBalance()` | read-only |
| `$ovo->history` | `getTransactionHistory()`, `getTabunganHistory()`, `getPayLaterHistory()`, `getTransactionDetail()`, `getRecentTransactions()`, `getReceiptContent()`, `addFavoriteFromReceipt()`, `deleteRecentTransaction()` | read-only |
| `$ovo->transfer` | `getBankList()`, `getTransferHistory()`, `inquiryTransfer()`, `verifyCustomerIsOvo()`, `getFavoriteTransfer()`, `addFavoriteBankTransfer()`, `addFavoriteP2pTransfer()`, `deleteFavoriteTransfer()` | read-only |
| `$ovo->transfer` | `transferBankDirect()`, `transferP2p()` | **EXECUTES a transfer** |
| `$ovo->payment` | `doQrPayment()`, `getPaymentMethod()`, `sendPayment()`, `getTip()`, `getCapPoint()` | payment / QR (⚠️ `doQrPayment` signature is experimental) |
| `$ovo->qris` | `qrScanPay()`, `generateCheckoutData()` | read-only |
| `$ovo->checkout` | `doCheckout()`, `getCheckoutDetail()`, `getPromos()`, `cancelPromo()` | merchant checkout |
| `$ovo->billpay` | `getCategories()`, `getBillersByCategory()`, `inquiry()`, `payBill()`, `editFavorite()`, ... | bill payment |
| `$ovo->linkage` | `getAllLinkages()`, `getTnc()`, `acceptTnc()`, `initiateLinkage()`, `linkPartnerAccount()`, `unlinkAccount()` | OAuth partner linkage |
| `$ovo->kyc` | `getCustomerUpgradeStatus()`, `getKycStatus()` | read-only |
| `$ovo->withdrawal` | `getWithdrawalSource()`, `getNominalSuggestions()`, `doWithdrawal()`, `generateWithdrawalCode()`, `getWithdrawalGuidance()` | cash out |
| `$ovo->topup` | `getTopUpMenu()`, `getTopupDenom()`, `topUpDebitPrepare()`, `topupDebit()` | top-up (debit card) |
| `$ovo->topupPartner` | `getStoreDetails()`, `generateTopUpPaymentCode()`, `getTopUpPaymentCode()` | top-up (voucher/agent) |
| `$ovo->security` | `unlock()`, `unlockActionMark()`, `unlockAndValidateTrxId()` | wallet unlock / PIN re-validation |

Methods that move real money throw `\Stelin\Exception\AmountException` if the amount is below
OVO's minimum (`10,000`). Always call the read-only `inquiryTransfer()` / `verifyCustomerIsOvo()`
first, and test with your own account before relying on this in anything unattended.

## Response envelope

Most endpoints wrap responses as `{response_code, response_version, response_message, data}` —
`Client` unwraps this and you get `data` back directly.

A few older endpoints use `{status, data, message}` instead (e.g. `wallet/inquiry`). Those do
**not** match the unwrap condition, so they're returned unmodified — read `['data']` yourself
for those specific calls (documented on the relevant method).

## Errors

Every **non-2xx** API response throws `\Stelin\Exception\ApiException`, which carries the
machine-readable OVO error code:

```php
use Stelin\Exception\ApiException;

try {
    $ovo->auth->requestOtp($msisdn, $deviceId);
} catch (ApiException $e) {
    // $e->responseCode: e.g. "OV00015" (rate limit), "OV00060" (invalid phone number)
    // $e->getMessage(): the human-readable message OVO sent
    // $e->payload: the full decoded response body
    // $e->httpStatus: the HTTP status code
}
```

Known codes:

| Code | Meaning |
|---|---|
| `OV00002` | field validation — message like `"<field>: non zero value required"` (empty `type`, `otp`, or `push_notification_id` in the login flow). Fill the field rather than retrying. |
| `OV00003` / `OV00521` | rate limit / cooldown (~30 min) |
| `OV00015` | OTP cooldown (~60 s) |
| `OV00013` | "Anda Tidak Memiliki Akses" — generic access-denied; often session-invalid or a pre-login endpoint rejecting this account/device. Not caused by headers anymore (`client-id` is correct). |
| `OV00060` | invalid phone number |

## Testing

```bash
composer install
composer test
```

Tests are pure unit tests (crypto round-trips, request/response shape assertions against a
fake HTTP client) — nothing hits the real API, so `composer test` is safe to run without
credentials.
