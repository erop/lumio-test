<?php

namespace App\Context\Transaction\Infrastructure\Service;

use App\Context\Threshold\Domain\ThresholdRepositoryInterface;
use App\Context\Transaction\Domain\Model\Threshold;

class ThresholdAdapter implements ThresholdAdapterInterface
{
    public function __construct(private ThresholdRepositoryInterface $repository)
    {
    }

    public function findThreshold(string $userId, \DateTimeImmutable $date): Threshold
    {
        $this->repository->find($userId, $date);
    }
}