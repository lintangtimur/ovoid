
<p align="center">
<a href="https://packagist.org/packages/lintangtimur/ovoid"><img src="https://img.shields.io/packagist/v/lintangtimur/ovoid.svg?style=popout-square"></a>
  <a href="https://github.com/lintangtimur/ovoid/blob/master/LICENSE"><img src="https://img.shields.io/github/license/lintangtimur/ovoid.svg?style=popout-square"></a>
  <a class="badge-align" href="https://www.codacy.com/app/lintangtimur/ovoid?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=lintangtimur/ovoid&amp;utm_campaign=Badge_Grade"><img src="https://api.codacy.com/project/badge/Grade/9699ecb8baf64fdb94692b90b01c73b1"/></a>
  <img alt="Packagist" src="https://img.shields.io/packagist/dt/lintangtimur/ovoid?style=flat-square">
<img alt="patreons" src="https://img.shields.io/endpoint?url=https://shieldsio-patreon.herokuapp.com/lintangtimur&style=flat">
  


</p>

  ### Untuk Donasi
https://trakteer.id/stefanus-lintang/tip

<h2 align="center">Un-Official ovoid API Wrapper</h2>

Telah di test pada OVO versi 3.43.0 | 24 September 2021 | PHP 7.2.2


| Method  | Result  | OVO Version
|---|---| --- |
| `OTP`  | OK | 3.43.0(5 okt 21)
| `OTPValidation`  | OK | 3.43.0 (5 okt 21)
| `accountLogin`  | OK  | 3.43.0 (5 okt 21)
| `getBudget`  | OK | 3.43.0 (24 sept 21)
| `balanceModel`  | OK  | 3.43.0 (24 sept 21)
| `logout`  | not tested  | 3.43.0 (24 sept 21)
| `unreadHistory`  | tested | 3.43.0 (5 okt 21)
| `getWalletTransaction`  | OK | 3.43.0 (24 sept 21)
| `detailHistory`  |  tested  | 3.43.0 (5 okt 21)
| `balance`  |  tested  | 3.43.0 (5 okt 21)
| `generateTrxId`  | not tested  | 3.43.0 (24 sept 21)
| `transferOvo`  | not tested  | 3.43.0 (24 sept 21)


## PORTS
Jika PHP tidak nyaman bagimu bisa mencoba bahasa pemrograman lain, atau jika ingin menulis dibahasa tersebut silahkan ajukan Issue baru nanti akan saya list disini

### Python
- [@anysz/ovopy](https://github.com/anysz/ovopy) by [anysz](https://github.com/anysz)

### Flutter
- [@maulana20/ovoid-flutter](https://github.com/maulana20/ovoid-flutter) by [maulana20](https://github.com/maulana20)

### GO
- [@adibaulia/ovoid-go](https://github.com/adibaulia/ovoid-go) by [adibaulia](https://github.com/adibaulia)

### Java
- 

### Ruby
- [@namdevel/ovoid-ruby](https://github.com/namdevel/ovoid-ruby) by [namdevel](https://github.com/namdevel)

### Javascript / nodejs
- [@apriady/ovoid-nodejs](https://github.com/apriady/ovoid-nodejs) by [apriady](https://github.com/apriady)

## Install
`composer require lintangtimur/ovoid`

## Login
### first step
```php
require 'vendor/autoload.php';
use Stelin\OVOID;

$ovo = new OVOID(null, "contoh-device-id");
echo $ovo->OTP("+62xxxxxxxx")->getData()->getOtp()->getOtpRefId();
```
### second step
```php
echo $ovo->OTPValidation("+62xxxxxx", "otp-ref-id", "otp")->getData()->getOtp()->getOtpToken();
```
### third step
```php
echo $ovo->accountLogin("+62xxxxx", 'otp-ref-id', 'otp-token', '6-digit-security-code')->getData()->getAuth()->getAccessToken();
```

## Balance Model
### Get Payment Method
`getPaymentMethod()`

### Get Card Balance
`getCardBalance($payment_method)`

### Get Card No
`getCardNo($payment_method)`

## EXAMPLE
```php
<?php

require 'vendor/autoload.php';

use Stelin\OVOID;
$ovoid = new OVOID($authToken);
dd($ovoid->modelBalance()->getBalance()->getCardNo()('OVO'));
```

## Profile Model

## Permission Model

## Transfer Sesama OVO
<pre>
Telah di test di OVO 2.8.0
</pre>
Sebelum transfer silahkan cek akunnya benar atau tidak dengan method ```isOVO()```, lalu jalankan method dibawah
```php
public function transferOvo($to_mobilePhone, $amount, $message = null)
```
Sementara hanya bisa 2 kali transfer, untuk transfer ke-3 dari OVO butuh header signature. Jika ada yang bisa menemukan proses signaturenya silahkan ajukan pull request dengan senang hati :)

## Transaction History
```php
/**
     * Wallet Transaction
     *
     * @param int $page halaman ke berapa
     * @param int $limit berapa kontent dalam 1 page
     * @return \Stelin\Response\WalletTransactionResponse
     */
    public function getWalletTransaction($page, $limit = 10)
```
disitu ada hardcode productType 001, bisa dicoba sendiri itu efek terhadap apa, karena saya tesnya hasil transfer sesama OVO.

### Mendapatkan semua notif
```php
    /**
     * get all notification
     *
     * @return \Stelin\Response\NotificationAllResponse
     */
    public function allNotification()
```

### Cek berapa notifikasi yang belum dibaca
```php
/**
     * mendapatkan total unread history
     *
     * @return \Stelin\Response\NotificationUnread
     */
    public function unreadHistory()
```
Contoh: `$ovo->unreadHistory()->getTotal()`

### Transfer Antar Bank
```php

    /**
     * transer antar bank
     *
     * @param  string                                  $accountName          nama akun
     * @param  string                                  $accountNo            No akun OVO Cash
     * @param  string                                  $accountNoDestination No rekening yang dituju
     * @param  int                                     $amount               jumlah yang akan ditransfer
     * @param  string                                  $bankCode             kode bank yang dituju
     * @param  string                                  $bankName             nama bank
     * @param  string                                  $message
     * @param  string                                  $notes
     * @return \Stelin\Response\TransferDirectResponse
     */
    public function transferBank($accountName, $accountNo, $accountNoDestination, $amount, $bankCode, $bankName, $message, $notes)
```

## TODO
- [x] Signature Header untuk transfer sesama OVO lebih dari 2x


## Contribute
Project ini saya membuatnya kasaran sekali, jadi ketika ada proses request ke endpoint ovo dan terjadi kegagalan atau parameter tidak sesuai, script masih belum bisa mendapatkan response error dari ovo nya, harus manual `dd` dari source code(dari file Response). Jadi silahkan berkontribusi, baik dari dokumentasi program atau membenahi script ini :)
