<?php
namespace Stelin\Response;

class DenominationsReponse
{
    private $denominations;

    public function __construct($data)
    {
        $this->denominations = $data;
    }

    public function getDenominations()
    {
        return $this->denominations;
    }
}