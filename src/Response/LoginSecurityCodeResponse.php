<?php

namespace Stelin\Response;

class LoginSecurityCodeResponse
{
    private $token;
    private $tokenSeed;
    private $timeStamp;
    private $tokenSeedExpiredAt;
    private $displayMessage;
    private $email;
    private $fullName;
    private $isEmailVerified;
    private $isSecurityCodeSet;
    private $updateAccessToken;

    public function __construct($data)
    {
        $this->token = $data->token;
        $this->tokenSeed = $data->tokenSeed;
        $this->timeStamp = $data->timeStamp;
        $this->tokenSeedExpiredAt = $data->tokenSeedExpiredAt;
        $this->displayMessage = $data->displayMessage;
        $this->email = $data->email;
        $this->fullName = $data->fullName;
        $this->isEmailVerified = $data->isEmailVerified;
        $this->isSecurityCodeSet = $data->isSecurityCodeSet;
        $this->updateAccessToken = $data->updateAccessToken;
    }

    /**
     * Get the value of token
     *
     */
    public function getAuthorizationToken()
    {
        return $this->token;
    }

    /**
     * Get the value of tokenSeed
     */
    public function getTokenSeed()
    {
        return $this->tokenSeed;
    }

    /**
     * Get the value of timeStamp
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * Get the value of tokenSeedExpiredAt
     */
    public function getTokenSeedExpiredAt()
    {
        return $this->tokenSeedExpiredAt;
    }

    /**
     * Get the value of displayMessage
     */
    public function getDisplayMessage()
    {
        return $this->displayMessage;
    }

    /**
     * Get account email
     *
     * @return string
     */
    public function getEmail()
    {
    }

    /**
     * Get full account name
     *
     * @return string
     */
    public function getFullName()
    {
    }

    /**
     * Check if email is veirified or not
     *
     * @return boolean
     */
    public function isEmailVerified()
    {
        return $this->isEmailVerified;
    }

    /**
     * check if is security code set
     *
     * @return boolean
     */
    public function isSecurityCodeSet()
    {
    }

    public function getUdateAccessToken()
    {
        return $this->updateAccessToken;
    }
}
