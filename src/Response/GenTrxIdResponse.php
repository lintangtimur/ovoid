<?php

namespace Stelin\Response;

class GenTrxIdResponse
{
    /**
     * trxid
     *
     * @var string
     */
    private $trxId;

    public function __construct($data)
    {
        $this->trxId = $data->trxId;
    }

    /**
     * get value of TrxId
     *
     * @return string
     */
    public function getTrxId()
    {
        return $this->trxId;
    }
}
