<?php

namespace App\Context\Transaction\Domain;

interface TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void;

    public function findDayTransactions(string $userId, \DateTimeImmutable $startingFrom): array;
}