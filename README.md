# ovoid
Un-Official ovoid API Wrapper

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
