<?php

namespace App\Context\Transaction\Domain\Service;

use App\Context\Shared\Contracts\MoneyInterface;
use App\Context\Transaction\Domain\Money;

class CurrencyConverter
{
    // Fake converter
    public function convert(MoneyInterface $baseMoney, string $quoteCurrency = null): MoneyInterface
    {
        if (null === $quoteCurrency) {
            return $baseMoney;
        }
        return new Money($baseMoney->getAmount(), $quoteCurrency);
    }
}