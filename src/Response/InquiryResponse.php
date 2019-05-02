<?php
namespace Stelin\Response;

class InquiryResponse
{

    private $response;

    public function __construct($data)
    {
        $this->response= $data;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }
}