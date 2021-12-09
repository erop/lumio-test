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

    public function findByUserIdAndDate(string $userId, \DateTimeImmutable $date): ?Threshold
    {
        /** @var Threshold $threshold */
        $threshold = $this->findOneBy(['startingFrom' <= $date], ['startingFrom' => 'DESC']);
        return $threshold;
    }
}