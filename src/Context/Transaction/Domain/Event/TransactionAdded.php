<?php

namespace App\Context\Transaction\Domain\Event;

class TransactionAdded
{
    public function __construct(private string $transactionId, private string $userId)
    {
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}