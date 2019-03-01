<?php

namespace Stelin\Response;

class CustomerTransferResponse
{
    private $code;
    private $message;
    private $isOvo;

    public function __construct($data)
    {
        $this->code = $data->code;
        $this->message = $data->message;
        $this->isOvo = $data->isOvo;
    }

    /**
     * code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get transaction message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * is ovo
     *
     * @return int
     */
    public function isOvo()
    {
        return $this->isOvo;
    }
}
