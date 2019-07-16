<?php

namespace Stelin\Response;

class BankResponse
{
    private $resp;

    public function __construct($data)
    {
        $this->resp = $data;
    }

    /**
     * Get Bank Transfer Response
     *
     * @return mixed
     */
    public function getBankResponse()
    {
        return $this->resp;
    }
}
