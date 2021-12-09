<?php

namespace App\Context\Transaction\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;
use App\Context\Transaction\Domain\Money;
use App\Context\Transaction\Domain\Service\CurrencyConverter;
use App\Context\Transaction\Domain\Service\ThresholdServiceInterface;
use App\Context\Transaction\Domain\Transaction;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class CheckThresholdHandler implements CommandHandlerInterface
{
    public function __construct(private ThresholdServiceInterface $thresholdService, private TransactionRepositoryInterface $repository, private CurrencyConverter $converter, private EventBusInterface $eventBus)
    {
    }

    public function __invoke(CheckThreshold $command): void
    {
        $userId = $command->getUserId();
        $date = $command->getDate();
        $threshold = $this->thresholdService->findThreshold($userId, $date);

        $transactions = $this->repository->findDayTransactions($userId, $date);

        $withdrawal = 0;
        $thresholdMoney = $threshold->getMoney();
        $thresholdAmount = $thresholdMoney->getAmount();
        $thresholdCurrency = $thresholdMoney->getCurrency();

        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            $converted = $this->converter->convert($transaction->getMoney(), $thresholdCurrency);
            $transactionAmount = $converted->getAmount();
            $transactionType = $transaction->getType();
            if ('debit' === $transactionType) {
                $withdrawal -= $transactionAmount;
            }
            if ('credit' === $transactionType) {
                $withdrawal += $transactionAmount;
            }
        }
        $spent = new Money($withdrawal, $thresholdCurrency);

        if (0 < $overspending = $withdrawal - $thresholdAmount) {
            $this->eventBus->dispatch(new \App\Context\Transaction\Domain\Event\OverspendingOccurred($userId, $date, new Money($overspending, $thresholdCurrency)));
        }
    }
}