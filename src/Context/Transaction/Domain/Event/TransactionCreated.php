<?php

namespace App\Context\Transaction\Domain\Event;

class TransactionCreated
{
    public function __construct(private string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}