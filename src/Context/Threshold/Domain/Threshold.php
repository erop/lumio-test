<?php

namespace App\Context\Threshold\Domain;

use Symfony\Component\Uid\Uuid;

class Threshold
{
    private string $id;

    private \DateTimeImmutable $startingFrom;

    public function __construct(
        private string              $userId,
        private Money               $money,
        ?\DateTimeImmutable $startingFrom = null)
    {
        $this->id = (string)Uuid::v4();
        $this->startingFrom = $startingFrom ?? new \DateTimeImmutable();
    }

    public function asArray(): array
    {
        return [
            'id' => $this->getId(),
            'userId' => $this->getUserId(),
            'startingFrom' => $this->getStartingFrom(),
            'money' => [
                'amount' => $this->getMoney()->getAmount(),
                'currency' => $this->getMoney()->getCurrency(),
            ],
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getStartingFrom(): \DateTimeImmutable
    {
        return $this->startingFrom;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}