<?php

namespace App\Context\Transaction\Application\EventHandler;

use App\Context\Shared\Application\Bus\Event\IntegrationEventHandlerInterface;
use App\Context\Shared\Integration\Event\ThresholdCreated;
use App\Context\Transaction\Domain\Service\TransactionCalculator;
use Psr\Log\LoggerInterface;

class CheckTransactionsAgainstThreshold implements IntegrationEventHandlerInterface
{
    public function __construct(
        private TransactionCalculator $calculatorService,
        private LoggerInterface       $logger)
    {
    }

    public function __invoke(ThresholdCreated $event): void
    {
        $userId = $event->getUserId();
        $currency = $event->getMoney()->getCurrency();
        $thresholdAmount = $event->getMoney()->getAmount();
        $startingFrom = $event->getStartingFrom();

        if (!$this->isThresholdSetForToday($startingFrom)) {
            return;
        }

        $outcome = $this->calculatorService->calculateOutcomeInCurrency($userId, $startingFrom, $currency);

        $outcomeAmount = $outcome->getAmount();
        if (0 < $overspending = $outcomeAmount - $thresholdAmount) {
            $this->logger->emergency(
                sprintf('Overspending for "%s%d" over current threshold of "%s%d" occurred for the userId "%s"',
                    $currency, $overspending, $currency, $thresholdAmount, $userId)
            );
        }
    }


    private function isThresholdSetForToday(\DateTimeImmutable $startingFrom): bool
    {
        $now = new \DateTimeImmutable();
        $dayStart = $now->setTime(0, 0, 0);
        $dayFinish = $now->setTime(23, 59, 59);
        return $dayStart <= $startingFrom && $startingFrom <= $dayFinish;
    }
}