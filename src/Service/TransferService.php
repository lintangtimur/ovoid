<?php

declare(strict_types=1);

namespace Stelin\Service;

use Stelin\Client;
use Stelin\Exception\AmountException;

/**
 * Bank & P2P transfer.
 *
 * {@see transferBankDirect()} and {@see transferP2p()} MOVE REAL MONEY. Always call
 * {@see inquiryTransfer()} first, and test against your own account before relying on this.
 */
final class TransferService
{
    private const MINIMUM_AMOUNT = 10_000;

    private const PATH_BANK_LIST = 'v1.0/reference/master/ref_bank';
    private const PATH_HISTORY = 'wallet/transaction/last';
    private const PATH_INQUIRY = 'transfer/inquiry';
    private const PATH_BANK_DIRECT = 'transfer/direct';
    private const PATH_P2P = 'v1.0/api/customers/transfer';
    private const PATH_VERIFY_IS_OVO = 'v1.1/api/auth/customer/isOVO';

    public function __construct(private readonly Client $client)
    {
    }

    public function getBankList(): array
    {
        return $this->client->get(self::PATH_BANK_LIST);
    }

    /** GET /wallet/transaction/last — transfer history. @param list<string> $transactionType */
    public function getTransferHistory(int $limit, array $transactionType = []): array
    {
        return $this->client->get(self::PATH_HISTORY, [
            'limit' => $limit,
            'transaction_type' => implode(',', $transactionType),
        ]);
    }

    /** Read-only — check fees/validity before calling {@see transferBankDirect()}. */
    public function inquiryTransfer(
        string $accountNo,
        string $bankCode,
        string $bankName,
        string $amount,
        string $message = '',
    ): array {
        return $this->client->post(self::PATH_INQUIRY, [
            'accountNo' => $accountNo,
            'bankCode' => $bankCode,
            'bankName' => $bankName,
            'message' => $message,
            'amount' => $amount,
        ]);
    }

    /**
     * EXECUTES a real transfer to a bank account.
     *
     * @throws AmountException if `$amount` is below OVO's minimum transfer amount.
     */
    public function transferBankDirect(
        string $accountName,
        string $accountNo,
        string $accountNoDestination,
        string $amount,
        string $bankCode,
        string $bankName,
        string $message = '',
        string $notes = '',
        string $transactionId = '',
    ): array {
        $this->assertMinimumAmount($amount);

        return $this->client->post(self::PATH_BANK_DIRECT, [
            'accountName' => $accountName,
            'accountNo' => $accountNo,
            'accountNoDestination' => $accountNoDestination,
            'amount' => $amount,
            'bankCode' => $bankCode,
            'bankName' => $bankName,
            'notes' => $notes,
            'message' => $message,
            'transactionId' => $transactionId,
        ]);
    }

    /**
     * EXECUTES a real OVO-to-OVO transfer.
     *
     * @throws AmountException if `$amount` is below OVO's minimum transfer amount.
     */
    public function transferP2p(string $amount, string $to, string $trxId, ?string $message = null, ?string $note = null): array
    {
        $this->assertMinimumAmount($amount);

        return $this->client->post(self::PATH_P2P, [
            'amount' => $amount,
            'to' => $to,
            'trxId' => $trxId,
            'message' => $message,
            'note' => $note,
        ]);
    }

    /** Check whether a phone number belongs to an OVO account before transferring to it. */
    public function verifyCustomerIsOvo(string $mobile, string $amount, string $message = ''): array
    {
        return $this->client->post(self::PATH_VERIFY_IS_OVO, [
            'mobile' => $mobile,
            // The amount is sent under the JSON key `totalAmount` — it is NOT sent as `amount`.
            'totalAmount' => $amount,
            'message' => $message,
        ]);
    }

    /** POST <dynamic url> — add a favorite bank account. No static path. */
    public function addFavoriteBankTransfer(string $url, array $body): array
    {
        return $this->client->post($url, $body);
    }

    /** POST <dynamic url> — add a favorite P2P contact. No static path. */
    public function addFavoriteP2pTransfer(string $url, array $body): array
    {
        return $this->client->post($url, $body);
    }

    /** GET <dynamic url> — list of favorite transfer targets. No static path. */
    public function getFavoriteTransfer(string $url): array
    {
        return $this->client->get($url);
    }

    /** DELETE <dynamic url> — remove a favorite transfer target. No static path. */
    public function deleteFavoriteTransfer(string $url): array
    {
        return $this->client->del($url);
    }

    private function assertMinimumAmount(string $amount): void
    {
        if ((int) $amount < self::MINIMUM_AMOUNT) {
            throw new AmountException(sprintf('Minimum transfer amount is %d.', self::MINIMUM_AMOUNT));
        }
    }
}
