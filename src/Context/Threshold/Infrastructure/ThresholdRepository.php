<?php

namespace App\Context\Threshold\Infrastructure;

use App\Context\Threshold\Domain\Threshold;
use App\Context\Threshold\Domain\ThresholdRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\UnitOfWork;
use Doctrine\Persistence\ManagerRegistry;

class ThresholdRepository extends ServiceEntityRepository implements ThresholdRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Threshold::class);
    }

    public function save(Threshold $threshold): void
    {
        $entityManager = $this->getEntityManager();
        if (UnitOfWork::STATE_NEW === $entityManager->getUnitOfWork()->getEntityState($threshold)) {
            $entityManager->persist($threshold);
        }
        $entityManager->flush();
    }

    public function findLastByUserAndDate(string $userId, \DateTimeImmutable $date): ?Threshold
    {
        $qb = $this->createQueryBuilder('t');
        $qb->andWhere('t.startingFrom <= :date')
            ->orderBy('t.startingFrom', 'DESC')
            ->setParameter('date', $date)
            ->setMaxResults(1);
        $result = $qb->getQuery()->getResult();

        return $result[0] ?? null;
    }
}