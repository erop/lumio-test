<?php

namespace App\Context\Transaction\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandInterface;
use App\Context\Transaction\Domain\Money;

class CreateTransaction implements CommandInterface
{

    public function __construct(private string              $userId,
                                private Money               $money,
                                private string              $type,
                                private ?\DateTimeImmutable $time = null)
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

    public function getType(): string
    {
        return $this->type;
    }

    public function getTime(): ?\DateTimeImmutable
    {
        return $this->time;
    }
}