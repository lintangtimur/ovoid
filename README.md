# ovoid

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/dab27c0e57bd49a0a1d06d8d457a381f)](https://app.codacy.com/app/lintangtimur/ovoid?utm_source=github.com&utm_medium=referral&utm_content=lintangtimur/ovoid&utm_campaign=Badge_Grade_Dashboard)

Un-Official ovoid API Wrapper

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
