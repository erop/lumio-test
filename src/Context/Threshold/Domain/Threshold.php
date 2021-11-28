<?php

namespace App\Context\Threshold\Domain;

use Money\Money;

class Threshold
{
    private string $id;

    public function __construct(
        private string              $userId,
        private Money               $money,
        private ?\DateTimeImmutable $startingFrom = null)
    {
//        $this->id =
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getStartingFrom(): \DateTimeImmutable
    {
        return $this->startingFrom;
    }
}