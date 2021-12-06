<?php

namespace App\Context\Transaction\Domain\Service;

interface ThresholdCheckerInterface
{
    public function check(string $userId, \DateTimeImmutable $date, Threshold $threshold);
}