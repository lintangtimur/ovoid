<?php

namespace Stelin\Response;

class WalletTransactionResponse
{
    private $status;
    private $data;
    private $message;

    public function __construct($data)
    {
        $this->status = $data->status;
        $this->data = $data->data;
        $this->message = $data->message;
    }

    /**
     * get status value
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Dalam data terdapat PENDING dan COMPLETE
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
