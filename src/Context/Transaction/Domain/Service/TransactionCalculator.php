<?php

namespace App\Context\Transaction\Domain\Service;

use App\Context\Transaction\Domain\Money;
use App\Context\Transaction\Domain\Transaction;

class TransactionCalculator
{
    public function transactionsAmount(array $transactions, string $currency): Money
    {
        $intResult = 0;
        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            $money = $transaction->getMoney();
            $converted = $this->convertToCurrency($money, $currency);
            $transactionType = $transaction->getType();
            $amount = $converted->getAmount();
            switch ($transactionType) {
                case 'debit':
                    $intResult -= $amount;
                    break;
                case 'credit':
                    $intResult += $amount;
                    break;
                default:
                    throw new \DomainException(sprintf('Not allowed transaction type: "%s"', $transactionType));
            }
        }
        return new Money($intResult, $currency);
    }

    private function convertToCurrency(Money $money, string $currency): Money
    {
        return new Money($money->getAmount(), $currency); // fake currency conversion
    }
}