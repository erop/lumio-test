<?php

namespace App\Context\Shared\Integration\Event;

use App\Context\Shared\Application\Bus\Event\IntegragionEvent;
use App\Context\Shared\Domain\Money;

class ThresholdCreated implements IntegragionEvent
{
    public function __construct(private string             $thresholdId,
                                private string             $userId,
                                private Money              $money,
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

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getStartingFrom(): \DateTimeImmutable
    {
        return $this->startingFrom;
    }
}