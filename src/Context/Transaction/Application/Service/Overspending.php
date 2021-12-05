<?php

namespace App\Context\Transaction\Application\Service;

class Overspending
{
    public function __construct(private string             $userId,
                                private \DateTimeImmutable $from,
                                private \DateTimeImmutable $to,
                                private array              $transactions)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getFrom(): \DateTimeImmutable
    {
        return $this->from;
    }

    public function getTo(): \DateTimeImmutable
    {
        return $this->to;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }
}