<?php

namespace App\Context\Transaction\Infrastructure\Service;

use App\Context\Transaction\Domain\Model\Threshold;

interface ThresholdAdapterInterface
{
    public function findThreshold(string $userId, \DateTimeImmutable $date): Threshold;
}