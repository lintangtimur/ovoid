<?php

namespace Stelin\Response;

class Login2FAResponse
{
    private $refId;

    public function __construct($data)
    {
        $this->refId = $data->refId;
    }

    /**
     * get value of refId
     *
     * @return string
     */
    public function getRefId()
    {
        return $this->refId;
    }
}
