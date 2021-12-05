<?php

namespace App\Context\Transaction\Domain;

use App\Context\Shared\Contracts\MoneyInterface;

class Money implements MoneyInterface
{
    public function __construct(private int $amount, private string $currency)
    {
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}