<?php

namespace App\Context\Threshold\Domain;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Uid\Uuid;

class Threshold
{
    private string $id;

    public function __construct(
        private string              $userId,
        private Money               $money,
        private ?\DateTimeImmutable $startingFrom = null)
    {
        $this->id = (string)Uuid::v4();
        $now = new \DateTimeImmutable();
        if (null === $startingFrom) {
            $this->startingFrom = $now;
        } else {
            if ($startingFrom < $now) {
                throw new \DomainException('You can not set starting time in the past');
            }
        }
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