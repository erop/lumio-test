<?php

namespace App\Context\Transaction\Domain\Service;

use App\Context\Shared\Contracts\MoneyInterface;

class CurrencyConverter
{
    // Fake converter
    public function convert(MoneyInterface $baseMoney, string $quoteCurrency = null): MoneyInterface
    {
        return $baseMoney;
    }
}