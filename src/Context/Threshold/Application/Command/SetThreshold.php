<?php

namespace App\Context\Threshold\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandInterface;
use App\Context\Threshold\Domain\Money;

class SetThreshold implements CommandInterface
{
    public function __construct(
        private string              $userId,
        private Money               $money,
        private ?\DateTimeImmutable $startingFrom = null)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getStartingFrom(): ?\DateTimeImmutable
    {
        return $this->startingFrom;
    }
}
