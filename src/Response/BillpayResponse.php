<?php

namespace Stelin\Response;

class BillpayResponse
{
    /**
     *
     *
     * @var array
     */
    private $biller_list;

    public function __construct($data)
    {
        $this->biller_list = $data;
    }

    /**
     * list of bill
     *
     * @return array
     */
    public function getBillerList()
    {
        return $this->biller_list;
    }
}
