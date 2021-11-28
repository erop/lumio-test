<?php

namespace App\Context\Threshold\Domain;

use App\Context\Shared\Domain\Money;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass="\App\Context\Threshold\Infrastructure\ThresholdRepository")
 * @ORM\Table(name="thresholds")
 */
class Threshold
{
    private string $id;

    public function __construct(
        private string              $userId,
        private Money               $money,
        private ?\DateTimeImmutable $startingFrom = null)
    {
        $this->id = (string)Uuid::v4();
        if (null === $startingFrom) {
            $this->startingFrom = new \DateTimeImmutable();
        } else {
            if ($startingFrom < new \DateTimeImmutable()) {
                throw new \DomainException('You can not set starting time in the past');
            }
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

    public function getStartingFrom(): \DateTimeImmutable
    {
        return $this->startingFrom;
    }
}