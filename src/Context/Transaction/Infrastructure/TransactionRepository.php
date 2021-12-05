<?php

namespace App\Context\Transaction\Infrastructure;

use App\Context\Transaction\Domain\Transaction;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TransactionRepository extends ServiceEntityRepository implements TransactionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function findDayTransactions(string $userId, \DateTimeImmutable $startingFrom): array
    {
        return [];
    }
}