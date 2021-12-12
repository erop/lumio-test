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

        if (null === $threshold = $this->thresholdService->findByUserIdAndDate($userId, $date)) {
            return;
        }

        $outcome = $this->calculatorService->calculateOutcomeInCurrency($userId, $date, $threshold->getMoney()->getCurrency());

        $thresholdAmount = $threshold->getMoney()->getAmount();
        $outcomeAmount = $outcome->getAmount();
        if (0 < $overspending = $outcomeAmount - $thresholdAmount) {
            $this->logger->emergency(
                sprintf('Overspending for "%s%d" over current threshold of "%s%d" occurred for the userId "%s"',
                    $currency, $overspending, $currency, $thresholdAmount, $userId)
            );
        }
    }
}