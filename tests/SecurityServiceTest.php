<?php

declare(strict_types=1);

namespace Stelin\Tests;

use PHPUnit\Framework\TestCase;
use Stelin\Client;
use Stelin\Crypto;
use Stelin\Service\SecurityService;
use Stelin\Tests\Fixtures\RecordingHttpClient;

final class SecurityServiceTest extends TestCase
{
    public function testUnlockAndValidateTrxIdComputesSha1SignatureAutomatically(): void
    {
        $http = new RecordingHttpClient(200, json_encode([
            'response_code' => 'OV00000',
            'data' => [],
        ]));
        $client = new Client('device-1', $http);
        $security = new SecurityService($client);

        $security->unlockAndValidateTrxId('trx-1', '123456', '2.0', amount: '10000', deviceId: 'device-1');

        $sent = json_decode((string) $http->lastBody, true);

        self::assertSame('trx-1', $sent['trxId'] ?? null);
        self::assertSame('123456', $sent['securityCode'] ?? null);
        self::assertSame('2.0', $sent['version'] ?? null);
        // Auto-computed SHA-1 — this is the reference usage for Crypto::trxSignature().
        self::assertSame(Crypto::trxSignature('trx-1', '10000', 'device-1'), $sent['signature'] ?? null);
    }

    public function testUnlockAndValidateTrxIdAllowsManualSignatureOverride(): void
    {
        $http = new RecordingHttpClient(200, json_encode([
            'response_code' => 'OV00000',
            'data' => [],
        ]));
        $client = new Client('device-1', $http);
        $security = new SecurityService($client);

        $security->unlockAndValidateTrxId('trx-9', '123456', '2.0', signature: 'custom-sig');

        $sent = json_decode((string) $http->lastBody, true);

        self::assertSame('custom-sig', $sent['signature'] ?? null);
    }

    public function testUnlockAndValidateTrxIdOmitsSignatureWhenAmountAndDeviceIdMissing(): void
    {
        $http = new RecordingHttpClient(200, json_encode([
            'response_code' => 'OV00000',
            'data' => [],
        ]));
        $client = new Client('device-1', $http);
        $security = new SecurityService($client);

        $security->unlockAndValidateTrxId('trx-9', '123456', '2.0');

        $sent = json_decode((string) $http->lastBody, true);

        self::assertArrayNotHasKey('signature', $sent);
    }

    public function testUnlockSendsPlaintextSecurityCode(): void
    {
        $http = new RecordingHttpClient(200, json_encode([
            'response_code' => 'OV00000',
            'data' => [],
        ]));
        $client = new Client('device-1', $http);
        $security = new SecurityService($client);

        $security->unlock('123456', '3.166.0');

        $sent = json_decode((string) $http->lastBody, true);

        self::assertSame('123456', $sent['securityCode'] ?? null);
        self::assertSame('3.166.0', $sent['appVersion'] ?? null);
    }
}
