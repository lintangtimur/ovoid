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

    const AWS = 'https://apigw01.aws.ovo.id/';

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
            'deviceId' => gen_uuid(),
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
            'deviceId'          => gen_uuid(),
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
            'updateAccessToken'=> $updateAccessToken,
            'message'          => ''
        ];

        return $ch->post(OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/loginSecurityCode/verify', $data, $this->headers)->getResponse();
    }

    /**
     * Get budget detail
     *
     * Amount, spending, total spending, and summary
     *
     * @return \Stelin\Response\BudgetResponse
     */
    public function getBudget()
    {
        $ch = new Curl;

        return $ch->get(OVOID::BASE_ENDPOINT . 'v1.0/budget/detail', null, $this->_aditionalHeader())->getResponse();
    }

    /**
     * Get OVO Balance
     *
     * @return \Stelin\Response\FrontResponse
     */
    public function balanceModel()
    {
        $ch = new Curl;

        return $ch->get(OVOID::BASE_ENDPOINT . 'v1.0/api/front/', null, $this->_aditionalHeader())->getResponse();
    }

    /**
     * kirim cash sesama OVO
     *
     * @param  string                                   $to_mobilePhone
     * @param  int                                      $amount
     * @param  string                                   $message
     * @throws \Stelin\Exception\AmountException
     * @return \Stelin\Reponse\CustomerTransferResponse
     */
    public function transferOvo($to_mobilePhone, $amount, $message = null)
    {
        if ($amount < 10000) {
            throw new \Stelin\Exception\AmountException('Minimal 10.000');
        }

        $ch = new Curl;
        $data = [
            'to'       => $to_mobilePhone,
            'amount'   => $amount,
            'message'  => $message ? null : '',
            'trxId'    => $this->generateTrxId($to_mobilePhone, $amount)->getTrxId()
        ];

        return $ch->post(OVOID::BASE_ENDPOINT . 'v1.0/api/customers/transfer', $data, $this->_aditionalHeader())->getResponse();
    }

    /**
     * generate trxid
     *
     * @param  string                            $mobilePhone
     * @param  int                               $amount
     * @return \Stelin\Response\GenTrxIdResponse
     */
    private function generateTrxId($mobilePhone, $amount)
    {
        $ch = new Curl;
        $data = [
            'actionMark' => 'trf_ovo',
            'amount'     => $amount
        ];

        return $ch->post(OVOID::BASE_ENDPOINT . 'v1.0/api/auth/customer/genTrxId', $data, $this->_aditionalHeader())->getResponse();
    }

    /**
     * logout from OVO
     *
     * @return void
     */
    public function logout()
    {
        $ch = new Curl;

        return $ch->get(OVOID::BASE_ENDPOINT . 'v1.0/api/auth/customer/logout', null, $this->_aditionalHeader())->getResponse();
    }

    /**
     * Add Authorization token
     *
     * @return array
     */
    private function _aditionalHeader()
    {
        $temp = ['Authorization'=> $this->authToken];

        return array_merge($temp, $this->headers);
    }

    /**
     * mendapatkan total unread history
     *
     * @return \Stelin\Response\NotificationUnreadResponse
     */
    public function unreadHistory()
    {
        $ch = new Curl;

        return $ch->get(OVOID::BASE_ENDPOINT . 'v1.0/notification/status/count/UNREAD', null, $this->_aditionalHeader())->getResponse();
    }

    /**
     * get all notification
     *
     * @return \Stelin\Response\NotificationAllResponse
     */
    public function allNotification()
    {
        $ch = new Curl;

        return $ch->get(OVOID::BASE_ENDPOINT . 'v1.0/notification/status/all', null, $this->_aditionalHeader())->getResponse();
    }

    /**
     * Wallet Transaction
     *
     * @param  int                                        $page  halaman ke berapa
     * @param  int                                        $limit berapa kontent dalam 1 page
     * @return \Stelin\Response\WalletTransactionResponse
     */
    public function getWalletTransaction($page, $limit = 10)
    {
        $ch = new Curl;

        return $ch->get(
            OVOID::BASE_ENDPOINT . 'wallet/v2/transaction?page=' . $page . '&limit=' . $limit . '&productType=001',
            null,
            $this->_aditionalHeader()
        )->getResponse();
    }

    /**
     * Billpay
     *
     * @return \Stelin\Response\BillpayResponse
     */
    public function getBillers()
    {
        $ch = new Curl;

        return $ch->get(OVOID::AWS . 'gpdm/ovo/ID/v2/billpay/get-billers?categoryID=5C6', null, $this->_aditionalHeader())->getResponse();
    }

    /**
     * get denomination
     *
     * @param  int                                   $product_id product_id can be found from getBillers() endpoint
     * @return \Stelin\Response\DenominationsReponse
     */
    public function getDenominationByProductId($product_id)
    {
        $ch = new Curl;

        return $ch->get(OVOID::AWS . 'gpdm/ovo/ID/v1/billpay/get-denominations/' . $product_id, null, $this->_aditionalHeader())->getResponse();
    }

    /**
     * bayar
     *
     * @param  string                           $billerId   get this from getBillers()
     * @param  string                           $customerId phone number
     * @param  string                           $denomId    get this from getDenominationByProductId()
     * @param  string                           $productId  get this from getBillers()
     * @return \Stelin\Response\InquiryResponse
     */
    public function inquiry($billerId, $customerId, $denomId, $productId)
    {
        $ch = new Curl;
        $data = [
            'biller_id'       => (string)$billerId,
            'customer_id'     => $customerId,
            'denomination_id' => $denomId,
            'payment_method'  => [
                '001'
            ],
            'phone_number'=> $customerId,
            'product_id'  => (string)$productId,
            'period'      => 0
        ];

        return $ch->post(OVOID::AWS . 'gpdm/ovo/ID/v1/billpay/inquiry', $data, $this->_aditionalHeader())->getResponse();
    }

    /**
     * setelah menjalankan fungsi inquiry() lakukan fungsi customerUnlock
     *
     * @param  string $securityCode
     * @return void
     */
    public function customerUnlock($securityCode)
    {
        $ch = new Curl;
        $data = [
            'appVersion'  => '2.8.0',
            'securityCode'=> $securityCode
        ];

        return $ch->post(OVOID::BASE_ENDPOINT . 'v1.0/api/auth/customer/unlock', $data, $this->_aditionalHeader())->getResponse();
    }

    /**
     * pay
     *
     * @param  string                       $billerId
     * @param  string                       $customerId
     * @param  string                       $oder_id
     * @param  string                       $productId
     * @return \Stelin\Response\PayResponse
     */
    public function pay($billerId, $customerId, $order_id, $productId)
    {
        $ch = new Curl;
        $data = [
            'biller_id'     => $billerId,
            'customer_id'   => $customerId,
            'order_id'      => $order_id,
            'payment_method'=> [
                '001'
            ],
            'phone_number'=> $customerId,
            'product_id'  => $productId
        ];

        return $ch->post(OVOID::AWS . 'gpdm/ovo/ID/v1/billpay/pay', $data, $this->_aditionalHeader())->getResponse();
    }

    /**
     * get PayCheckStatusResponse
     *
     * @param  string                                  $oderId orderId reference
     * @return \Stelin\Response\PayCheckStatusResponse
     */
    public function payCheckStatus($orderId)
    {
        $ch = new Curl;

        $data = [
            'order_reference' => $orderId
        ];

        return $ch->post(OVOID::AWS . 'gpdm/ovo/ID/v1/billpay/checkstatus', $data, $this->_aditionalHeader())->getResponse();
    }
}
