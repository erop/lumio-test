<?php

namespace App\Context\Transaction\Infrastructure\Service;

use App\Context\Shared\Contracts\ThresholdAdapterInterface;
use App\Context\Transaction\Domain\Model\Threshold;
use App\Context\Transaction\Domain\Money;
use App\Context\Transaction\Domain\Service\ThresholdServiceInterface;

class ThresholdService implements ThresholdServiceInterface
{
    public function __construct(
        private ThresholdAdapterInterface $adapter
    )
    {
    }

    public function findByUserIdAndDate(string $userId, \DateTimeImmutable $date): ?Threshold
    {
        if (null === $struct = $this->adapter->findThresholdByUserAndDate($userId, $date)) {
            return null;
        }
        return new Threshold(
            $struct['userId'],
            $struct['date'],
            new Money(
                $struct['money']['amount'],
                $struct['money']['currency']
            )
        );
    }
}