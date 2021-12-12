<?php

namespace App\Context\Transaction\Domain\Model;

use App\Context\Shared\Contracts\MoneyInterface;

class Threshold
{
    public function __construct(
        private string             $userId,
        private \DateTimeImmutable $startingFrom,
        private MoneyInterface     $money)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getStartingFrom(): \DateTimeImmutable
    {
        return $this->startingFrom;
    }

    public function getMoney(): MoneyInterface
    {
        return $this->money;
    }
}