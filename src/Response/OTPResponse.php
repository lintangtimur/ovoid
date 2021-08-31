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
     * @var int
     */
    private $retryRemaining;

    /**
     * @var int
     */
    private $cooldownPeriod;

    /**
     * @var int
     */
    private $length;

    /**
     * @var string
     */
    private $reffType;

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
     * @return int|null
     */
    public function getRetryRemaining(): ?int
    {
        return $this->retryRemaining;
    }

    /**
     * @param int|null $retryRemaining
     *
     * @return Otp
     */
    public function setRetryRemaining(?int $retryRemaining): Otp
    {
        $this->retryRemaining = $retryRemaining;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCooldownPeriod(): ?int
    {
        return $this->cooldownPeriod;
    }

    /**
     * @param int|null $cooldownPeriod
     *
     * @return Otp
     */
    public function setCooldownPeriod(?int $cooldownPeriod): Otp
    {
        $this->cooldownPeriod = $cooldownPeriod;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     *
     * @return Otp
     */
    public function setLength(?int $length): Otp
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReffType(): ?string
    {
        return $this->reffType;
    }

    /**
     * @param string|null $reffType
     *
     * @return Otp
     */
    public function setReffType(?string $reffType): Otp
    {
        $this->reffType = $reffType;

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

class OTPResponse
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
                ->setType($data->data->otp->type)
                ->setRetryRemaining($data->data->otp->retry_remaining)
                ->setCooldownPeriod($data->data->otp->cooldown_period)
                ->setLength($data->data->otp->length)
                ->setReffType($data->data->otp->reff_type);
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
     * @return OTPResponse
     */
    public function setResponseCode(?string $responseCode): OTPResponse
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
     * @return OTPResponse
     */
    public function setResponseMessage(?string $responseMessage): OTPResponse
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
     * @return OTPResponse
     */
    public function setData(?Data $data): OTPResponse
    {
        $this->data = $data;

        return $this;
    }
}
