<?php
namespace Stelin\Response;

class PayCheckStatusResponse
{
    private $PayCheckStatusResponse;
    public function __construct($data)
    {
        $this->PayCheckStatusResponse = $data;
    }

    public function getPayCheckStatusResponse()
    {
        return $this->PayCheckStatusResponse;
    }
}