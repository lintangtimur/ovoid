<?php
namespace Stelin\Response;

class TransferDirectResponse
{
    private $resp;

    public function __construct($data)
    {
        $this->resp = $data;
    }

    public function getTransferDirectResponse()
    {
        return $this->resp;
    }
}