<?php

namespace App\Context\Transaction\Application\Command;

class CheckThreshold
{
    public function __construct(private string $userId, private ?\DateTimeImmutable $date = null)
    {
        if (null === $this->date) {
            $this->date = new \DateTimeImmutable();
        }
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}