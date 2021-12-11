<?php

namespace App\Context\Transaction\Infrastructure\Service;

use App\Context\Transaction\Domain\Model\Threshold;
use App\Context\Transaction\Domain\Service\ThresholdServiceInterface;

class ThresholdService implements ThresholdServiceInterface
{
    public function __construct(
        private ThresholdAdapterInterface $adapter,
        private ThresholdConverter        $converter)
    {
    }

    public function findThreshold(string $userId, \DateTimeImmutable $date): Threshold
    {
        $threshold = $this->converter->convert($this->adapter->findThreshold($userId, $date));
        return $threshold;
    }
}