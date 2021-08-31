<?php

namespace Stelin\HTTP;

use Stelin\HTTPClient;
use Stelin\ParseResponse;

class Curl implements HTTPClient
{
    /**
     * curl init
     *
     * @var string
     */
    private $ch;

    public function __construct()
    {
        $this->ch = curl_init();
    }

    /**
     * send post request
     *
     * @param  string                $url
     * @param  array                 $data
     * @param  array                 $headers
     * @return \Stelin\ParseResponse
     */
    public function post($url, $data, $headers)
    {
        $headerJson = ['Content-Type: application/json;charset=UTF-8'];

        $tempHeaders = [];

        foreach ($headers as $key => $value) {
            array_push($tempHeaders, $key . ': ' . $value);
        }
        
        $headers = array_merge($headerJson, $tempHeaders);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($this->ch);
        curl_close($this->ch);

        return new ParseResponse($result, $url);
    }

    /**
     * send get request
     *
     * @param  string                $url
     * @param  array                 $data
     * @param  array                 $headers
     * @return \Stelin\ParseResponse
     */
    public function get($url, $data, $headers)
    {
        $headerJson = ['Content-Type: application/json;charset=UTF-8'];

        $tempHeaders = [];

        foreach ($headers as $key => $value) {
            array_push($tempHeaders, $key . ': ' . $value);
        }
        $headers = array_merge($headerJson, $tempHeaders);

        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, false);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($this->ch);

        curl_close($this->ch);

        return new ParseResponse($result, $url);
    }
}
