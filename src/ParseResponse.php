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
        OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/login2FA'                       => 'Stelin\Response\Login2FAResponse',
        OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/login2FA/verify'                => 'Stelin\Response\Login2FAVerifyResponse',
        OVOID::BASE_ENDPOINT . 'v2.0/api/auth/customer/loginSecurityCode/verify'       => 'Stelin\Response\LoginSecurityCodeResponse',
        OVOID::BASE_ENDPOINT . 'v3.0/api/front/'                                       => 'Stelin\Response\FrontResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/budget/detail'                                    => 'Stelin\Response\BudgetResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/api/customers/transfer'                           => 'Stelin\Response\CustomerTransferResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/api/auth/customer/genTrxId'                       => 'Stelin\Response\GenTrxIdResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/notification/status/count/UNREAD'                 => 'Stelin\Response\NotificationUnreadResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/notification/status/all'                          => 'Stelin\Response\NotificationAllResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/api/auth/customer/logout'                         => 'Stelin\Response\LogoutResponse',
        OVOID::AWS . 'gpdm/ovo/ID/v2/billpay/get-billers?categoryID=5C6'               => 'Stelin\Response\BillpayResponse',
        OVOID::AWS . 'gpdm/ovo/ID/v1/billpay/inquiry'                                  => 'Stelin\Response\InquiryResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/api/auth/customer/unlock'                         => 'Stelin\Response\CustomerUnlockResponse',
        OVOID::AWS . 'gpdm/ovo/ID/v1/billpay/pay'                                      => 'Stelin\Response\PayResponse',
        OVOID::AWS . 'gpdm/ovo/ID/v1/billpay/checkstatus'                              => 'Stelin\Response\PayCheckStatusResponse',
        OVOID::BASE_ENDPOINT . 'v1.0/reference/master/ref_bank'                        => 'Stelin\Response\Ref_BankResponse',
        OVOID::BASE_ENDPOINT . 'transfer/inquiry'                                      => 'Stelin\Response\TransferInquiryResponse',
        OVOID::BASE_ENDPOINT . 'transfer/direct'                                       => 'Stelin\Response\TransferDirectResponse',
        OVOID::BASE_ENDPOINT . 'v1.1/api/auth/customer/isOVO'                          => 'Stelin\Response\isOVOResponse',
        OVOID::OVO_API_AWS . 'v3/user/accounts/otp'                                    => 'Stelin\Response\OTPResponse',
        OVOID::OVO_API_AWS . 'v3/user/accounts/otp/validation'                         => 'Stelin\Response\OTPValidationResponse',
        OVOID::OVO_API_AWS . 'v3/user/public_keys'                                     => 'Stelin\Response\PublicKeyResponse',
        OVOID::OVO_API_AWS . 'v3/user/accounts/login'                                  => 'Stelin\Response\AccountLoginResponse'

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
        //-- Cek apakah ada error dari OVO Response
        if (isset($jsonDecodeResult->code)) {
            throw new \Stelin\Exception\OvoidException($jsonDecodeResult->message . ' ' . $url);
        }

        $parts = parse_url($url);

        if ($parts['path'] == '/wallet/v3/transaction') {
            $this->response = new \Stelin\Response\WalletTransactionResponse($jsonDecodeResult);
        } elseif (strpos($parts['path'], '/gpdm/ovo/ID/v1/billpay/get-denominations/') !== false) {
            $this->response = new \Stelin\Response\DenominationsReponse($jsonDecodeResult);
        } else {
            $this->response = new $this->storeClass[$url]($jsonDecodeResult);
        }
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
