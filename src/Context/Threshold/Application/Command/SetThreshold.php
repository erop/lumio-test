<?php

namespace App\Context\Threshold\Application\Command;

use App\Context\Shared\Application\Bus\Command\ICommand;
use App\Context\Shared\Domain\Money;

class SetThreshold implements ICommand
{
    public function __construct(private string $userId, private Money $money)
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
}
