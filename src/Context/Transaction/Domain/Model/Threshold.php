<?php

namespace App\Context\Transaction\Domain\Model;

use App\Context\Shared\Domain\VO\Money;

class Threshold
{
    public function __construct(private string $userId, private string $date, private Money $money)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}