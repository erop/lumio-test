<?php

namespace App\Context\Transaction\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;
use App\Context\Shared\Application\Bus\Event\EventBusInterface;
use App\Context\Transaction\Domain\Event\OverspendingOccurred;
use App\Context\Transaction\Domain\Money;
use App\Context\Transaction\Domain\Service\CurrencyConverter;
use App\Context\Transaction\Domain\Service\ThresholdServiceInterface;
use App\Context\Transaction\Domain\Transaction;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class CheckThresholdHandler implements CommandHandlerInterface
{
    public function __construct(private ThresholdServiceInterface      $thresholdService,
                                private TransactionRepositoryInterface $repository,
                                private CurrencyConverter              $converter,
                                private EventBusInterface              $eventBus)
    {
    }

    public function __invoke(CheckThreshold $command): void
    {
        $userId = $command->getUserId();
        $date = $command->getDate();
        $threshold = $this->thresholdService->findThreshold($userId, $date);

        $transactions = $this->repository->findDayTransactions($userId, $date);

        $withdrawal = 0;
        $money = $threshold->getMoney();
        $amount = $money->getAmount();
        $currency = $money->getCurrency();

        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            $converted = $this->converter->convert($transaction->getMoney(), $currency);
            $transactionAmount = $converted->getAmount();
            $transactionType = $transaction->getType();
            if ('debit' === $transactionType) {
                $withdrawal -= $transactionAmount;
            }
            if ('credit' === $transactionType) {
                $withdrawal += $transactionAmount;
            }
        }

        if (0 < $overspending = $withdrawal - $amount) {
            $this->eventBus->dispatch(new OverspendingOccurred($userId, $date, new Money($overspending, $currency)));
        }
    }
}