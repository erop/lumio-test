<?php

namespace App\Context\Transaction\Domain;

use Symfony\Component\Uid\Uuid;

class Transaction
{
    public function __construct(private string $userId, private Money $money, private string $type)
    {
        $this->id = Uuid::v4();
    }
}