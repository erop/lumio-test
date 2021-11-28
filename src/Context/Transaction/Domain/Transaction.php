<?php

namespace App\Context\Transaction\Domain;

use Symfony\Component\Uid\Uuid;

class Transaction
{
    private string $id;

    public function __construct(private string $userId, private Money $money, private string $type, private ?\DateTimeImmutable $time = null)
    {
        $this->id = (string)Uuid::v4();
        if (null === $time) {
            $this->time = new \DateTimeImmutable();
        }
    }

    public function getId(): string
    {
        return $this->id;
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