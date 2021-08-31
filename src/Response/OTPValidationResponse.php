<?php
namespace Stelin\Response;

class Otp
{
    /**
     * @var string
     */
    private $otpRefId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $expiresAt;

    /**
     * @var string
     */
    private $otpToken;

    /**
     * @return string|null
     */
    public function getOtpRefId(): ?string
    {
        return $this->otpRefId;
    }

    /**
     * @param string|null $otpRefId
     *
     * @return Otp
     */
    public function setOtpRefId(?string $otpRefId): Otp
    {
        $this->otpRefId = $otpRefId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return Otp
     */
    public function setType(?string $type): Otp
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpiresAt(): ?int
    {
        return $this->expiresAt;
    }

    /**
     * @param int|null $expiresAt
     *
     * @return Otp
     */
    public function setExpiresAt(?int $expiresAt): Otp
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOtpToken(): ?string
    {
        return $this->otpToken;
    }

    /**
     * @param string|null $otpToken
     *
     * @return Otp
     */
    public function setOtpToken(?string $otpToken): Otp
    {
        $this->otpToken = $otpToken;

        return $this;
    }
}

class Data
{
    /**
     * @var Otp
     */
    private $otp;

    /**
     * @return Otp|null
     */
    public function getOtp(): ?Otp
    {
        return $this->otp;
    }

    /**
     * @param Otp|null $otp
     *
     * @return Data
     */
    public function setOtp(?Otp $otp): Data
    {
        $this->otp = $otp;

        return $this;
    }
}

class OTPValidationResponse
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
     * @var Data
     */
    private $data;

    public function __construct($data)
    {
        $this->responseCode    = $data->response_code;
        $this->responseMessage = $data->response_message;
        if ($data->data == null) {
            $this->data = null;
        } else {
            $d                     = new Data;
            $otp                   = new Otp;
            $otp->setOtpRefId($data->data->otp->otp_ref_id)
                ->setOtpToken($data->data->otp->otp_token)
                ->setType($data->data->otp->type)
                ->setExpiresAt($data->data->otp->expires_at);
            $this->data = $d->setOtp($otp);
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
     * @return OTPValidationResponse
     */
    public function setResponseCode(?string $responseCode): OTPValidationResponse
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
     * @return OTPValidationResponse
     */
    public function setResponseMessage(?string $responseMessage): OTPValidationResponse
    {
        $this->responseMessage = $responseMessage;

        return $this;
    }

    /**
     * @return Data|null
     */
    public function getData(): ?Data
    {
        return $this->data;
    }

    /**
     * @param Data|null $data
     *
     * @return OTPValidationResponse
     */
    public function setData(?Data $data): OTPValidationResponse
    {
        $this->data = $data;

        return $this;
    }
}
