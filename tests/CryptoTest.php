<?php

declare(strict_types=1);

namespace Stelin\Tests;

use PHPUnit\Framework\TestCase;
use Stelin\Crypto;

final class CryptoTest extends TestCase
{
    private const FIXTURES_DIR = __DIR__ . '/Fixtures';

    private string $publicKeyPem;
    private string $privateKeyPem;

    protected function setUp(): void
    {
        // Static fixture keypair (generated once via the `openssl` CLI, see Fixtures/README.md)
        // rather than `openssl_pkey_new()` at test time — some environments' PHP builds don't
        // have an `openssl.cnf` configured for key *generation*, only for using existing keys.
        $this->publicKeyPem = file_get_contents(self::FIXTURES_DIR . '/test-public.pem');
        $this->privateKeyPem = file_get_contents(self::FIXTURES_DIR . '/test-private.pem');
    }

    public function testRsaEncryptRoundTripsWithPkcs1Padding(): void
    {
        $encrypted = Crypto::rsaEncrypt('hello-ovo', $this->publicKeyPem);

        openssl_private_decrypt(base64_decode($encrypted), $decrypted, $this->privateKeyPem, OPENSSL_PKCS1_PADDING);

        self::assertSame('hello-ovo', $decrypted);
    }

    public function testRsaEncryptAcceptsRawDerAsWellAsPem(): void
    {
        // Strip PEM framing to simulate the raw base64 the API sometimes returns.
        $der = trim(str_replace(['-----BEGIN PUBLIC KEY-----', '-----END PUBLIC KEY-----', "\n"], '', $this->publicKeyPem));

        $encrypted = Crypto::rsaEncrypt('hello-ovo', $der);
        openssl_private_decrypt(base64_decode($encrypted), $decrypted, $this->privateKeyPem, OPENSSL_PKCS1_PADDING);

        self::assertSame('hello-ovo', $decrypted);
    }

    public function testBuildAuthSignaturePayloadFormat(): void
    {
        $payload = Crypto::buildAuthSignaturePayload('LOGIN', '123456', '+62812345678', 'device-1', 'ref-1');
        $parts = explode('|', $payload);

        self::assertCount(7, $parts, 'Payload must have exactly 7 pipe-separated fields.');
        [$type, $securityCode, $timestamp, $uuid, $phone, $deviceId, $otpRefId] = $parts;

        self::assertSame('LOGIN', $type);
        self::assertSame('123456', $securityCode);
        self::assertMatchesRegularExpression('/^\d+$/', $timestamp);
        self::assertMatchesRegularExpression('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid);
        self::assertSame('0812345678', $phone, 'msisdn "+62" prefix must become "0".');
        self::assertSame('device-1', $deviceId);
        self::assertSame('ref-1', $otpRefId);
    }

    public function testTrxSignatureIsSha1OfPipeJoinedFields(): void
    {
        self::assertSame(sha1('trx-1||10000||device-1'), Crypto::trxSignature('trx-1', '10000', 'device-1'));
    }

    public function testUuidV4ProducesUniqueValues(): void
    {
        self::assertNotSame(Crypto::uuidV4(), Crypto::uuidV4());
    }
}
