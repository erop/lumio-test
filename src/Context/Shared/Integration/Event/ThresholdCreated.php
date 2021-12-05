<?php

namespace App\Context\Shared\Integration\Event;

use App\Context\Shared\Application\Bus\Event\IntegrationEventInterface;
use App\Context\Shared\Contracts\MoneyInterface;


class ThresholdCreated implements IntegrationEventInterface
{
    public function __construct(private string             $thresholdId,
                                private string             $userId,
                                private MoneyInterface     $money,
                                private \DateTimeImmutable $startingFrom)
    {
    }

    public function getThresholdId(): string
    {
        return $this->thresholdId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getMoney(): MoneyInterface
    {
        return $this->money;
    }

    public function getStartingFrom(): \DateTimeImmutable
    {
        return $this->startingFrom;
    }
}