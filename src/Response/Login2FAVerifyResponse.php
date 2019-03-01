<?php

namespace Stelin\Response;

class Login2FAVerifyResponse
{
    private $mobile;
    private $email;
    private $fullName;
    private $isEmailVerified;
    private $isSecurityCodeSet;
    private $updateAccessToken;

    public function __construct($data)
    {
        $this->mobile = $data->mobile;
        $this->email = $data->email;
        $this->fullName = $data->fullName;
        $this->isEmailVerified = $data->isEmailVerified;
        $this->isSecurityCodeSet = $data->isSecurityCodeSet;
        $this->updateAccessToken = $data->updateAccessToken;
    }

    /**
     * Get the value of Mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Get account email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get full account name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
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
        return $this->isSecurityCodeSet;
    }

    /**
     * Get the value update access token
     *
     * @return string
     */
    public function getUpdateAccessToken()
    {
        return $this->updateAccessToken;
    }
}
