<?php

namespace App\Context\Shared\Contracts;

use App\Context\Transaction\Domain\Model\Threshold;

interface ThresholdAdapterInterface
{
    public function findThresholdByUserAndDate(string $userId, \DateTimeImmutable $date): ?array;
}