<?php

use PHPUnit\Framework\TestCase;
use Stelin\OVOID;
use Stelin\Meta\Meta;
use Stelin\Response\Login2FAResponse;
use Stelin\ParseResponse;

class OvoidTest extends TestCase
{
    /**
     * ovoid
     *
     * @var \Stelin\OVOID
     */
    private $ovoid;

    /**
     * curl
     *
     * @var \Stelin\HTTP\Curl
     */
    private $curl;

    public function setUp()
    {
        $this->ovoid = new OVOID();
    }

    public function tearDown()
    {
    }

    public function testMetaValue()
    {
        $this->assertSame('C7UMRSMFRZ46D9GW9IK7', Meta::APP_ID);
        $this->assertNotSame('asd', META::APP_ID);
        $this->assertIsString(Meta::APP_ID);

        $this->assertSame('2.8.0', Meta::APP_VERSION);
        $this->assertNotSame('1', Meta::APP_VERSION);
        $this->assertSame('Android', Meta::OS_NAME);
        $this->assertSame('8.1.0', Meta::OS_VERSION);
        $this->assertSame('02:00:00:44:55:66', Meta::MAC_ADDRESS);
        $this->assertSame('5d1fa7f9-fd99-3bae-95d5-67fedb901502', Meta::DEVICE_ID);
    }

    public function testEndpointValue()
    {
        $this->assertSame('https://api.ovo.id/', OVOID::BASE_ENDPOINT);
        $this->assertNotEquals('https://api.ovo.id', OVOID::BASE_ENDPOINT);
    }

    public function testLogin2FAResponse()
    {
        $data = <<<JSON
{
"refId":"123"
}
JSON;

        $login2faresponse = new Login2FAResponse(json_decode($data));
        $this->assertEquals("123", $login2faresponse->getRefId());
    }
}
