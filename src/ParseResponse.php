<?php

namespace Stelin;

class ParseResponse
{
    /**
     * store Class
     *
     * @var array
     */
    public $storeClass = [
        OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/login2FA'          => 'Stelin\Response\Login2FAResponse',
        OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/login2FA/verify'   => 'Stelin\Response\Login2FAVerifyResponse',
        OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/loginSecurityCode' => 'Stelin\Response\LoginSecurityCodeResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/api/front/'                          => 'Stelin\Response\FrontResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/budget/detail'                       => 'Stelin\Response\BudgetResponse'
    ];

    private $response;

    /**
     * Parse response init
     *
     * @param mixed  $chResult
     * @param string $url
     */
    public function __construct($chResult, $url)
    {
        $jsonDecodeResult = json_decode($chResult);
        $this->response = new $this->storeClass[$url]($jsonDecodeResult);
    }

    /**
     * Get response following by class
     *
     * @return void
     */
    public function getResponse()
    {
        return $this->response;
    }
}
