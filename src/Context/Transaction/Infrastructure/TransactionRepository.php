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

    public function findDayTransactions(string $userId, \DateTimeImmutable $date = null): array
    {
        if (null === $date) {
            $date = new \DateTimeImmutable();
        }
        $qb = $this->createQueryBuilder('tr');
        $qb
            ->andWhere('tr.time BETWEEN :start AND :end')
            ->setParameter('start', $date->setTime(0, 0, 0)->format(\DateTimeInterface::ATOM))
            ->setParameter('end', $date->setTime(23, 59, 59)->format(\DateTimeInterface::ATOM));
        $result = $qb->getQuery()->getResult();

        return $result;
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