<?php

namespace App\Context\Transaction\Domain\Model;

use App\Context\Shared\Contracts\MoneyInterface;
use App\Context\Shared\Domain\VO\Money;

class Threshold
{
    public function __construct(private string $userId, private \DateTimeImmutable $date, private MoneyInterface $money)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getMoney(): MoneyInterface
    {
        return $this->money;
    }
}