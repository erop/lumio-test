<?php

namespace App\Context\Transaction\Application\EventHandler;

use App\Context\Shared\Application\Bus\Event\IntegrationEventHandlerInterface;
use App\Context\Shared\Integration\Event\ThresholdCreated;
use App\Context\Transaction\Domain\Service\TransactionCalculator;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class ThresholdCreatedHandler implements IntegrationEventHandlerInterface
{
    public function __construct(private TransactionRepositoryInterface $repository,
                                private TransactionCalculator          $transactionCalculator)
    {
    }

    public function __invoke(ThresholdCreated $event)
    {
        $userId = $event->getUserId();
        $startingFrom = $event->getStartingFrom();
        if (!$this->isThresholdSetForToday($startingFrom)) {
            return;
        }
        $todayTransactions = $this->repository->findDayTransactions($userId, $startingFrom);

        // todo finish implementation
    }

    private function isThresholdSetForToday(\DateTimeImmutable $startingFrom)
    {
        $now = new \DateTimeImmutable();
        $dayStart = $now->setTime(0, 0, 0);
        $dayFinish = $now->setTime(23, 59, 59);
        return $dayStart <= $startingFrom && $startingFrom <= $dayFinish;
    }

}