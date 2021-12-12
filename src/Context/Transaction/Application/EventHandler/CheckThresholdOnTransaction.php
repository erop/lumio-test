<?php

namespace App\Context\Transaction\Application\EventHandler;

use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;
use App\Context\Transaction\Domain\Event\TransactionAdded;
use App\Context\Transaction\Domain\Service\ThresholdServiceInterface;
use App\Context\Transaction\Domain\Service\TransactionCalculator;
use Psr\Log\LoggerInterface;

class CheckThresholdOnTransaction implements EventHandlerInterface
{
    public function __construct(
        private TransactionCalculator     $calculatorService,
        private ThresholdServiceInterface $thresholdService,
        private LoggerInterface           $logger
    )
    {
    }

    public function __invoke(TransactionAdded $event): void
    {
        $userId = $event->getUserId();
        $date = $event->getTime();
        $currency = $event->getMoney()->getCurrency();

        $threshold = $this->thresholdService->findThreshold($userId, $date);

        $outcome = $this->calculatorService->calculateOutcomeInCurrency($userId, $date, $threshold->getMoney()->getCurrency());

        $thresholdAmount = $threshold->getMoney()->getAmount();
        $outcomeAmount = $outcome->getAmount();
        if (0 < $overspending = $outcomeAmount - $thresholdAmount) {
            $this->logger->info(sprintf('Overspending of "%s%d" occurred for the userId "%s"', $currency, $overspending, $userId));
        }
    }
}