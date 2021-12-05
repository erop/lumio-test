<?php

namespace App\Context\Transaction\Domain;

interface TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void;
    /**
     * @return array|Transaction[]
     */
    public function findDayTransactions(string $userId, \DateTimeImmutable $startingFrom): array;
}