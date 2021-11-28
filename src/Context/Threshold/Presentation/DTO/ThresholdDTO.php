<?php

namespace App\Context\Threshold\Presentation\DTO;

use Money\Money;

class ThresholdDTO
{
    public function __construct(private string $userId, private Money $money)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}