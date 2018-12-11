<?php

namespace Stelin\Response\Model;

class Balance
{
    private $paymentMethod = [
        'OVO'      => '',
        'OVO Cash' => ''
    ];

    /**
     * data from frontResponse
     *
     * @param object $data
     */
    public function __construct($data)
    {
        $ovoCash = [
            'cardBalance' => (float)$data->{'001'}->card_balance,
            'card_no'     => $data->{'001'}->card_no
        ];

        $ovo = [
            'cardBalance' => (int)$data->{'600'}->card_balance,
            'card_no'     => $data->{'600'}->card_no
        ];

        $this->paymentMethod['OVO Cash'] = $ovoCash;
        $this->paymentMethod['OVO'] = $ovo;
    }

    /**
     *Get Payment Method
     *
     * @return array
     */
    public function getPaymentMethod()
    {
        return array_keys($this->paymentMethod);
    }

    /**
     * Get the value of card balance by payment method name
     *
     * @param  string    $paymenMethod
     * @return int|float
     */
    public function getCardBalance($paymenMethod)
    {
        return $this->paymentMethod[$paymenMethod]['cardBalance'];
    }

    /**
     * Get the value of card no by payment method name
     *
     * @param  string $paymenMethod
     * @return void
     */
    public function getCardNo($paymenMethod)
    {
        return $this->paymentMethod[$paymenMethod]['card_no'];
    }
}
