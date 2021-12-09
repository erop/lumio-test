<?php

namespace App\Context\Transaction\Domain\Event;

use App\Context\Shared\Application\Bus\Event\EventInterface;
use App\Context\Transaction\Domain\Money;
use DateTimeImmutable;

class OverspendingOccurred implements EventInterface
{
    private DateTimeImmutable $occurredAt;

    public function __construct(private string $userId, private DateTimeImmutable $date, private Money $money)
    {
        $this->occurredAt = new DateTimeImmutable();
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getParam(): Money
    {
        return $this->money;
    }

    public function occurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}