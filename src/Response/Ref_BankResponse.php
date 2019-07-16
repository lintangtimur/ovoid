<?php

namespace Stelin\Response;

/**
 * LIST BANK
 */
class Ref_BankResponse
{
    private $response;

    public function __construct($data)
    {
        $this->response = $data;
    }

    /**
     * response
     *
     * @return void
     */
    public function getRefBankResponse()
    {
        return $this->response;
    }
}
