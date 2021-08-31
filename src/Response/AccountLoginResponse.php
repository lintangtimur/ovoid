<?php
namespace Stelin\Response;

class Auth
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $tokenType;

    /**
     * @var int
     */
    private $expiresIn;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * @var string
     */
    private $scope;

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @param string|null $accessToken
     *
     * @return Auth
     */
    public function setAccessToken(?string $accessToken): Auth
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTokenType(): ?string
    {
        return $this->tokenType;
    }

    /**
     * @param string|null $tokenType
     *
     * @return Auth
     */
    public function setTokenType(?string $tokenType): Auth
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpiresIn(): ?int
    {
        return $this->expiresIn;
    }

    /**
     * @param int|null $expiresIn
     *
     * @return Auth
     */
    public function setExpiresIn(?int $expiresIn): Auth
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * @param string|null $refreshToken
     *
     * @return Auth
     */
    public function setRefreshToken(?string $refreshToken): Auth
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param string|null $scope
     *
     * @return Auth
     */
    public function setScope(?string $scope): Auth
    {
        $this->scope = $scope;

        return $this;
    }
}

class Account
{
    /**
     * @var string
     */
    private $ovoId;

    /**
     * @var string
     */
    private $msisdn;

    /**
     * @var string
     */
    private $accountStatus;

    /**
     * @var string
     */
    private $kycStatus;

    /**
     * @var string
     */
    private $authentication;

    /**
     * @var string
     */
    private $pushNotificationId;

    /**
     * @return string|null
     */
    public function getOvoId(): ?string
    {
        return $this->ovoId;
    }

    /**
     * @param string|null $ovoId
     *
     * @return Account
     */
    public function setOvoId(?string $ovoId): Account
    {
        $this->ovoId = $ovoId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMsisdn(): ?string
    {
        return $this->msisdn;
    }

    /**
     * @param string|null $msisdn
     *
     * @return Account
     */
    public function setMsisdn(?string $msisdn): Account
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAccountStatus(): ?string
    {
        return $this->accountStatus;
    }

    /**
     * @param string|null $accountStatus
     *
     * @return Account
     */
    public function setAccountStatus(?string $accountStatus): Account
    {
        $this->accountStatus = $accountStatus;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKycStatus(): ?string
    {
        return $this->kycStatus;
    }

    /**
     * @param string|null $kycStatus
     *
     * @return Account
     */
    public function setKycStatus(?string $kycStatus): Account
    {
        $this->kycStatus = $kycStatus;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthentication(): ?string
    {
        return $this->authentication;
    }

    /**
     * @param string|null $authentication
     *
     * @return Account
     */
    public function setAuthentication(?string $authentication): Account
    {
        $this->authentication = $authentication;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPushNotificationId(): ?string
    {
        return $this->pushNotificationId;
    }

    /**
     * @param string|null $pushNotificationId
     *
     * @return Account
     */
    public function setPushNotificationId(?string $pushNotificationId): Account
    {
        $this->pushNotificationId = $pushNotificationId;

        return $this;
    }
}

class DataAccRes
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * @var Account
     */
    private $account;

    /**
     * @return Auth|null
     */
    public function getAuth(): ?Auth
    {
        return $this->auth;
    }

    /**
     * @param Auth|null $auth
     *
     * @return DataAccRes
     */
    public function setAuth(?Auth $auth): DataAccRes
    {
        $this->auth = $auth;

        return $this;
    }

    /**
     * @return Account|null
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * @param Account|null $account
     *
     * @return DataAccRes
     */
    public function setAccount(?Account $account): DataAccRes
    {
        $this->account = $account;

        return $this;
    }
}

class AccountLoginResponse
{
    /**
     * @var string
     */
    private $responseCode;

    /**
     * @var string
     */
    private $responseMessage;

    /**
     * @var DataAccRes
     */
    private $data;

    public function __construct($data)
    {
        $this->responseCode    = $data->response_code;
        $this->responseMessage = $data->response_message;
        if ($data->data == null) {
            $this->data = null;
        } else {
            $d                     = new DataAccRes;
            $d->setAuth(
                (new Auth)->setAccessToken($data->data->auth->access_token)
                    ->setTokenType($data->data->auth->token_type)
                    ->setExpiresIn($data->data->auth->expires_in)
                    ->setRefreshToken($data->data->auth->refresh_token)
                    ->setScope($data->data->auth->scope)
            )->setAccount(
                (new Account)->setOvoId($data->data->account->ovo_id)
                    ->setMsisdn($data->data->account->msisdn)
                    ->setAccountStatus($data->data->account->account_status)
                    ->setKycStatus($data->data->account->kyc_status)
                    ->setAuthentication($data->data->account->authentication)
                    ->setPushNotificationId($data->data->account->push_notification_id)
            );

            $this->data = $d;
        }
    }

    /**
     * @return string|null
     */
    public function getResponseCode(): ?string
    {
        return $this->responseCode;
    }

    /**
     * @param string|null $responseCode
     *
     * @return AccountLoginResponse
     */
    public function setResponseCode(?string $responseCode): AccountLoginResponse
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResponseMessage(): ?string
    {
        return $this->responseMessage;
    }

    /**
     * @param string|null $responseMessage
     *
     * @return AccountLoginResponse
     */
    public function setResponseMessage(?string $responseMessage): AccountLoginResponse
    {
        $this->responseMessage = $responseMessage;

        return $this;
    }

    /**
     * @return DataAccRes|null
     */
    public function getData(): ?DataAccRes
    {
        return $this->data;
    }

    /**
     * @param DataAccRes|null $data
     *
     * @return AccountLoginResponse
     */
    public function setData(?DataAccRes $data): AccountLoginResponse
    {
        $this->data = $data;

        return $this;
    }
}
