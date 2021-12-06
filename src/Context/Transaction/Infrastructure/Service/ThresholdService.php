<?php

namespace App\Context\Transaction\Infrastructure\Service;

use App\Context\Transaction\Domain\Model\Threshold;
use App\Context\Transaction\Domain\Service\ThresholdServiceInterface;

class ThresholdService implements ThresholdServiceInterface
{
    public function __construct(private ThresholdAdapterInterface $adapter)
    {
    }

    public function findThreshold(string $userId, \DateTimeImmutable $date): Threshold
    {
        $threshold = (new ThresholdConverter())->convert($this->adapter->find($userId)) ;
        return $threshold;
    }
}