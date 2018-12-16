
<p align="center">
<a href="https://packagist.org/packages/lintangtimur/ovoid"><img src="https://img.shields.io/packagist/v/lintangtimur/ovoid.svg?style=popout-square"></a>
  <a href="https://github.com/lintangtimur/ovoid/blob/master/LICENSE"><img src="https://img.shields.io/github/license/lintangtimur/ovoid.svg?style=popout-square"></a>
  <a class="badge-align" href="https://www.codacy.com/app/lintangtimur/ovoid?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=lintangtimur/ovoid&amp;utm_campaign=Badge_Grade"><img src="https://api.codacy.com/project/badge/Grade/9699ecb8baf64fdb94692b90b01c73b1"/></a>
</p>
<h2 align="center">Un-Official ovoid API Wrapper</h2>

## Install
`composer require lintangtimur/ovoid`

## Login
### first step
```php
require 'vendor/autoload.php';
use Stelin\OVOID;

$ovoid = new OVOID();
echo $ovoid->login2FA('<mobilePhone>')->getRefId());
```
### second step
```php
echo $ovoid->login2FAVerify('<refId>', '<OTP code>', '<mobilePhone>')->getUdateAccessToken();
```
### third step
```php
echo $ovoid->loginSecurityCode('<pin code>', '<updateAccessToken>')->getAuthorizationToken();
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
