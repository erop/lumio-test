<?php

namespace App\Context\Transaction\Domain\Event;

use App\Context\Shared\Application\Bus\Event\EventInterface;
use App\Context\Transaction\Domain\Money;

class TransactionAdded implements EventInterface
{
    private \DateTimeImmutable $occurredAt;

    public function __construct(
        private string             $transactionId,
        private string             $userId,
        private \DateTimeImmutable $time,
        private Money              $money
    )
    {
        $this->occurredAt = new \DateTimeImmutable();
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getTime(): \DateTimeImmutable
    {
        return $this->time;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function occurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}