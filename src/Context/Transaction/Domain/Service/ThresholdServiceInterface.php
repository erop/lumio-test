<?php

namespace App\Context\Transaction\Domain\Service;

use App\Context\Transaction\Domain\Model\Threshold;

interface ThresholdServiceInterface
{
    public function findThreshold(string $userId, \DateTimeImmutable $date): Threshold;
}