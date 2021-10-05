<?php
namespace Stelin\Response;

/**
 * OVO Cash dalam Rupiah
 */
class BR001
{
    /**
     * @var int
     */
    private $cardBalance;

    /**
     * @var string
     */
    private $cardNo;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @return int|null
     */
    public function getCardBalance(): ?int
    {
        return $this->cardBalance;
    }

    /**
     * @param int|null $cardBalance
     *
     * @return BR001
     */
    public function setCardBalance(?int $cardBalance): BR001
    {
        $this->cardBalance = $cardBalance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardNo(): ?string
    {
        return $this->cardNo;
    }

    /**
     * @param string|null $cardNo
     *
     * @return BR001
     */
    public function setCardNo(?string $cardNo): BR001
    {
        $this->cardNo = $cardNo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string|null $paymentMethod
     *
     * @return BR001
     */
    public function setPaymentMethod(?string $paymentMethod): BR001
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }
}

/**
 * OVO POINT
 */
class BR600
{
    /**
     * @var int
     */
    private $cardBalance;

    /**
     * @var string
     */
    private $cardNo;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @return int|null
     */
    public function getCardBalance(): ?int
    {
        return $this->cardBalance;
    }

    /**
     * @param int|null $cardBalance
     *
     * @return BR600
     */
    public function setCardBalance(?int $cardBalance): BR600
    {
        $this->cardBalance = $cardBalance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardNo(): ?string
    {
        return $this->cardNo;
    }

    /**
     * @param string|null $cardNo
     *
     * @return BR600
     */
    public function setCardNo(?string $cardNo): BR600
    {
        $this->cardNo = $cardNo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string|null $paymentMethod
     *
     * @return BR600
     */
    public function setPaymentMethod(?string $paymentMethod): BR600
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }
}

class BRData
{
    /**
     * @var BR001
     */
    private $BR001;

    /**
     * @var BR600
     */
    private $BR600;

    /**
     * OVO Cash dalam rupiah
     * @return BR001|null
     */
    public function get001(): ?BR001
    {
        return $this->BR001;
    }

    /**
     * @param BR001|null $BR001
     *
     * @return BRData
     */
    public function set001(?BR001 $BR001): BRData
    {
        $this->BR001 = $BR001;

        return $this;
    }

    /**
     * OVO point
     * @return BR600|null
     */
    public function get600(): ?BR600
    {
        return $this->BR600;
    }

    /**
     * @param BR600|null $BR600
     *
     * @return BRData
     */
    public function set600(?BR600 $BR600): BRData
    {
        $this->BR600 = $BR600;

        return $this;
    }
}

class BalanceResponse
{
    /**
     * @var int
     */
    private $status;

    /**
     * @var BRData
     */
    private $data;

    /**
     * @var string
     */
    private $message;

    public function __construct($data)
    {
        $this->status  = $data->status;
        $this->message = $data->message;
        if ($data->data == null) {
            $this->data = null;
        } else {
            $d = new BRData();
            $d->set001((new BR001)->setCardBalance($data->data->{'001'}->card_balance)
                ->setCardNo($data->data->{'001'}->card_no)
                ->setPaymentMethod($data->data->{'001'}->payment_method))
            ->set600((new BR600)->setCardBalance($data->data->{'600'}->card_balance)
            ->setCardNo($data->data->{'600'}->card_no)
            ->setPaymentMethod($data->data->{'600'}->payment_method));
            $this->data = $d;
        }
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     *
     * @return BalanceResonse
     */
    public function setStatus(?int $status): BalanceResonse
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return BRData|null
     */
    public function getData(): ?BRData
    {
        return $this->data;
    }

    /**
     * @param BRData|null $data
     *
     * @return BalanceResonse
     */
    public function setData(?BRData $data): BalanceResonse
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     *
     * @return BalanceResonse
     */
    public function setMessage(?string $message): BalanceResonse
    {
        $this->message = $message;

        return $this;
    }
}
