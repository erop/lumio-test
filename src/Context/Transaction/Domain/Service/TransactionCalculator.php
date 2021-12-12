<?php

namespace App\Context\Transaction\Domain\Service;

use App\Context\Transaction\Domain\Money;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class TransactionCalculator
{
    public function __construct(
        private TransactionRepositoryInterface $repository,
        private CurrencyConverter              $converter
    )
    {
    }

    public function calculateOutcomeInCurrency(string $userId, \DateTimeImmutable $date, string $currency): Money
    {
        $amount = 0;
        $transactions = $this->repository->findDayTransactions($userId, $date);
        foreach ($transactions as $transaction) {
            $converted = $this->converter->convert($transaction->getMoney(), $currency);
            switch ($type = $transaction->getType()) {
                case 'debit':
                    $amount += $converted->getAmount();
                    break;
                case 'credit':
                    $amount -= $converted->getAmount();
                    break;
                default:
                    throw new \DomainException(sprintf('Unknown transaction type "%s" used', $type));
            }
        }
        return new Money($amount, $currency);
    }
}