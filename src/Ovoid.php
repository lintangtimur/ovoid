<?php

namespace Stelin;

use Stelin\HTTP\Curl;
use Stelin\Meta\Meta;

/**
 * OVOID
 *
 * @author lintangtimur <lintangtimur915@gmail.com>
 * @package library
 * @license MIT
 */
class OVOID
{
    /**
     * Base OVO ENDPOINT
     */
    const BASE_ENDPOINT = 'https://api.ovo.id/';

    /**
     * Authorization Token
     *
     * @var string
     */
    private $authToken;

    private $headers = [
        'app-id'      => Meta::APP_ID,
        'App-Version' => Meta::APP_VERSION,
        'OS'          => Meta::OS_NAME
    ];

    public function __construct($authToken = null)
    {
        $this->authToken = $authToken;
    }

    /**
     * login2FA
     *
     * Proses login yang harus dilalui yaitu dengan ini, hasil respon berupa
     * refId yang akan digunakan selanjutnya
     *
     * @param  string                            $mobile_phone
     * @return \Stelin\Response\Login2FAResponse
     */
    public function login2FA($mobile_phone)
    {
        $ch = new Curl;
        $headers = [
            'app-id'      => Meta::APP_ID,
            'App-Version' => Meta::APP_VERSION
        ];

        $data = [
            'deviceId' => Meta::DEVICE_ID,
            'mobile'   => $mobile_phone
        ];

        return $ch->post(OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/login2FA', $data, $this->headers)->getResponse();
    }

    /**
     * Verify login
     *
     * @param  string                                  $refId
     * @param  string                                  $verificationCode 4 digit
     * @param  string                                  $mobilePhone      phone number Example: 085289...
     * @return \Stelin\Response\Login2FAVerifyResponse
     */
    public function login2FAVerify($refId, $verificationCode, $mobilePhone)
    {
        $ch = new Curl;

        $data = [
            'appVersion'        => Meta::APP_VERSION,
            'deviceId'          => Meta::DEVICE_ID,
            'macAddress'        => Meta::MAC_ADDRESS,
            'mobile'            => $mobilePhone,
            'osName'            => Meta::OS_NAME,
            'osVersion'         => Meta::OS_VERSION,
            'pushNotificationId'=> 'FCM|f4OXYs_ZhuM:APA91bGde-ie2YBhmbALKPq94WjYex8gQDU2NMwJn_w9jYZx0emAFRGKHD2NojY6yh8ykpkcciPQpS0CBma-MxTEjaet-5I3T8u_YFWiKgyWoH7pHk7MXChBCBRwGRjMKIPdi3h0p2z7',
            'refId'             => $refId,
            'verificationCode'  => $verificationCode
        ];

        return $ch->post(OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/login2FA/verify', $data, $this->headers)->getResponse();
    }

    /**
     * Login Secruity Code
     *
     * @param  string                                     $securityCode      MAX is 6 digit
     * @param  string                                     $updateAccessToken
     * @return \Stelin\Response\LoginSecurityCodeResponse
     */
    public function loginSecurityCode($securityCode, $updateAccessToken)
    {
        $ch = new Curl;
        $data = [
            'deviceUnixtime'   => 1543693061,
            'securityCode'     => $securityCode,
            'updateAccessToken'=> $updateAccessToken
        ];

        return $ch->post(OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/loginSecurityCode', $data, $this->headers)->getResponse();
    }

    /**
     * Get OVO Balance
     *
     * @return \Stelin\Response\FrontResponse
     */
    public function modelBalance()
    {
        $ch = new Curl;

        return $ch->get(OVOID::BASE_ENDPOINT . 'v1.0/api/front/', null, $this->_aditionalHeader())->getResponse();
    }

    /**
     * Add Authorization token
     *
     * @return array
     */
    private function _aditionalHeader()
    {
        return ['Authorization: ' . $this->authToken];
    }
}
