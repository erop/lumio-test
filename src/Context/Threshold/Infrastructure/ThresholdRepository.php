<?php

namespace App\Context\Threshold\Infrastructure;

use App\Context\Threshold\Domain\ThresholdRepositoryInterface;
use App\Context\Threshold\Domain\Threshold;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        $entityManager->persist($threshold);
        $entityManager->flush();
    }
}