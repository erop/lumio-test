<?php

namespace App\Context\Transaction\Infrastructure;

use App\Context\Transaction\Domain\Transaction;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\UnitOfWork;
use Doctrine\Persistence\ManagerRegistry;

class TransactionRepository extends ServiceEntityRepository implements TransactionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function findDayTransactions(string $userId, \DateTimeImmutable $date): array
    {
        $this->findBy(['userId' => $userId, 'date' => new \DateTimeImmutable()]);
    }

    public function save(Transaction $transaction): void
    {
        $entityManager = $this->getEntityManager();
        if (UnitOfWork::STATE_NEW === $entityManager->getUnitOfWork()->getEntityState($transaction)) {
            $entityManager->persist($transaction);
        }
        $entityManager->flush();
    }
}