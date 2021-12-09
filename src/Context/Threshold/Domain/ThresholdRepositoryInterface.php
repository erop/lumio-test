<?php

namespace App\Context\Threshold\Domain;

interface ThresholdRepositoryInterface
{
    public function save(Threshold $threshold): void;

    public function findByUserIdAndDate(string $userId, \DateTimeImmutable $date): ?Threshold;
}