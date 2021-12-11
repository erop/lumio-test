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
        $dql = 'SELECT t FROM App\Context\Threshold\DOMAIN\Threshold t WHERE t.startingFrom <= :startingFrom ORDER BY t.startingFrom DESC';
        $query = $this->_em->createQuery($dql)
            ->setParameter('startingFrom', $date);
        $result = $query->getFirstResult();

        return $result;
    }
}