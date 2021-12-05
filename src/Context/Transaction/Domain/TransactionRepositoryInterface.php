<?php

namespace App\Context\Transaction\Domain;

interface TransactionRepositoryInterface
{
    /**
     * @return array|Transaction[]
     */
    public function findDayTransactions(string $userId, \DateTimeImmutable $startingFrom): array;
}