<?php

namespace App\Context\Shared\Contracts;

interface MoneyInterface
{
    public function getAmount(): int;

    public function getCurrency(): string;
}