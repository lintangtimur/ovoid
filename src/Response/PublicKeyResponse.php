<?php
namespace Stelin\Response;

class Keys
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $format;

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     *
     * @return Keys
     */
    public function setKey(?string $key): Keys
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param string|null $format
     *
     * @return Keys
     */
    public function setFormat(?string $format): Keys
    {
        $this->format = $format;

        return $this;
    }
}

class Data
{
    /**
     * @var array
     */
    private $keys;

    /**
     * @return array|null
     */
    public function getKeys(): ?array
    {
        return $this->keys;
    }

    /**
     * @param array|null $keys
     *
     * @return Data
     */
    public function setKeys(?array $keys): Data
    {
        $this->keys = $keys;

        return $this;
    }
}

class PublicKeyResponse
{
    /**
     * @var string
     */
    private $responseCode;

    /**
     * @var string
     */
    private $responseMessage;

    /**
     * @var Data
     */
    private $data;

    public function __construct($data)
    {
        $this->responseCode     = $data->response_code;
        $this->responseMessage  = $data->response_message;
        if ($data->data == null) {
            $this->data = null;
        } else {
            $d                      = new Data;
            $this->data             = $d->setKeys($data->data->keys);
        }
    }

    /**
     * @return string|null
     */
    public function getResponseCode(): ?string
    {
        return $this->responseCode;
    }

    /**
     * @param string|null $responseCode
     *
     * @return PublicKeyResponse
     */
    public function setResponseCode(?string $responseCode): PublicKeyResponse
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResponseMessage(): ?string
    {
        return $this->responseMessage;
    }

    /**
     * @param string|null $responseMessage
     *
     * @return PublicKeyResponse
     */
    public function setResponseMessage(?string $responseMessage): PublicKeyResponse
    {
        $this->responseMessage = $responseMessage;

        return $this;
    }

    /**
     * @return Data|null
     */
    public function getData(): ?Data
    {
        return $this->data;
    }

    /**
     * @param Data|null $data
     *
     * @return PublicKeyResponse
     */
    public function setData(?Data $data): PublicKeyResponse
    {
        $this->data = $data;

        return $this;
    }
}
