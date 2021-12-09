<?php

namespace App\Context\Transaction\Infrastructure\Service;

use App\Context\Shared\Contracts\MoneyPatternConverter;
use App\Context\Shared\Domain\VO\Money;
use App\Context\Threshold\Domain\Threshold as ForeignThreshold;
use App\Context\Threshold\Domain\ThresholdRepositoryInterface;
use App\Context\Transaction\Domain\Model\Threshold;


class ThresholdAdapter implements ThresholdAdapterInterface
{
    public function __construct(private ThresholdRepositoryInterface $repository)
    {
    }

    public function findThreshold(string $userId, \DateTimeImmutable $date): ?Threshold
    {
        /** @var ForeignThreshold $foreignThreshold */
        $foreignThreshold = $this->repository->findByUserIdAndDate($userId, $date);
        return new Threshold(
            $foreignThreshold->getUserId(),
            $date,
            MoneyPatternConverter::convert($foreignThreshold->getMoney(), Money::class)
        );
    }
}