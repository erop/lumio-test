<?php

namespace App\Context\Transaction\Domain;

interface TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void;

    /**
     * @param string $userId
     * @param \DateTimeImmutable $startingFrom
     * @return array|Transaction[]
     */
    public function findDayTransactions(string $userId, \DateTimeImmutable $startingFrom = null): array;
}