<?php

declare(strict_types=1);

namespace Stelin\Tests;

use PHPUnit\Framework\TestCase;
use Stelin\Client;
use Stelin\Exception\ApiException;
use Stelin\Tests\Fixtures\RecordingHttpClient;

final class ClientTest extends TestCase
{
    public function testUnwrapsTheModernResponseEnvelope(): void
    {
        $http = new RecordingHttpClient(200, json_encode([
            'response_code' => 'OV00000',
            'response_message' => 'Success',
            'data' => ['foo' => 'bar'],
        ]));

        $client = new Client('device-1', $http);

        self::assertSame(['foo' => 'bar'], $client->get('any/path'));
    }

    public function testPassesThroughTheLegacyEnvelopeUnmodified(): void
    {
        // `wallet/inquiry` and a few other older endpoints use {status, data, message}
        // instead of {response_code, response_message, data} — Client must not touch it.
        $legacyPayload = ['status' => 200, 'data' => ['001' => ['card_balance' => 1000]], 'message' => ''];
        $http = new RecordingHttpClient(200, json_encode($legacyPayload));

        $client = new Client('device-1', $http);

        self::assertSame($legacyPayload, $client->get('wallet/inquiry'));
    }

    public function testThrowsApiExceptionWithTheResponseCodeOnHttpError(): void
    {
        $http = new RecordingHttpClient(400, json_encode([
            'response_code' => 'OV00013',
            'response_message' => 'Anda Tidak Memiliki Akses',
        ]));

        $client = new Client('device-1', $http);

        try {
            $client->post('v3/user/accounts/otp', ['msisdn' => '+62812345678']);
            self::fail('Expected ApiException was not thrown.');
        } catch (ApiException $e) {
            self::assertSame('OV00013', $e->responseCode);
            self::assertSame('Anda Tidak Memiliki Akses', $e->getMessage());
            self::assertSame(400, $e->httpStatus);
        }
    }

    public function testInjectsTheConfirmedIdentityHeaders(): void
    {
        $http = new RecordingHttpClient(200, json_encode(['response_code' => 'OV00000', 'data' => []]));
        $client = new Client('device-xyz', $http);

        $client->get('some/path');

        self::assertSame('ovo_android', $http->lastHeaders['client-id']);
        self::assertSame('device-xyz', $http->lastHeaders['device-id']);
        self::assertSame('3.166.0', $http->lastHeaders['App-Version']);
        self::assertArrayNotHasKey('Authorization', $http->lastHeaders);
    }

    public function testAddsBearerAuthorizationOnceAnAccessTokenIsSet(): void
    {
        $http = new RecordingHttpClient(200, json_encode(['response_code' => 'OV00000', 'data' => []]));
        $client = new Client('device-1', $http);

        $client->setAccessToken('token-123');
        $client->get('some/path');

        self::assertSame('Bearer token-123', $http->lastHeaders['Authorization']);
    }

    public function testGetRequestsAppendQueryParameters(): void
    {
        $http = new RecordingHttpClient(200, json_encode(['response_code' => 'OV00000', 'data' => []]));
        $client = new Client('device-1', $http, 'https://agw.ovo.id/');

        $client->get('payment/orders/v1/list', ['page' => 1, 'limit' => 10]);

        self::assertSame('https://agw.ovo.id/payment/orders/v1/list?page=1&limit=10', $http->lastUrl);
    }
}
