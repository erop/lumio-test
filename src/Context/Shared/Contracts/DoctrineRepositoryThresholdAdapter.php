<?php

namespace App\Context\Shared\Contracts;

use App\Context\Threshold\Domain\ThresholdRepositoryInterface;

class DoctrineRepositoryThresholdAdapter implements ThresholdAdapterInterface
{
    public function __construct(
        private ThresholdRepositoryInterface $thresholdRepository
    )
    {
    }

    public function findThresholdByUserAndDate(string $userId, \DateTimeImmutable $date): ?array
    {
        if (null === $threshold = $this->thresholdRepository->findLastByUserAndDate($userId, $date)) {
            return null;
        }
        return $threshold->asArray();
    }
}