<?php

namespace App\Context\Transaction\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;
use App\Context\Shared\Application\Bus\Event\EventBusInterface;
use App\Context\Transaction\Domain\Event\TransactionAdded;
use App\Context\Transaction\Domain\Transaction;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class CreateTransactionHandler implements CommandHandlerInterface
{
    public function __construct(
        private TransactionRepositoryInterface $repository,
        private EventBusInterface              $eventBus)
    {
    }

    public function __invoke(CreateTransaction $command): void
    {
        $userId = $command->getUserId();
        $transaction = new Transaction(
            $userId,
            $command->getMoney(),
            $command->getType(),
            $command->getTime()
        );
        $this->repository->save($transaction);

        $this->eventBus->dispatch(
            new TransactionAdded(
                $transaction->getId(),
                $transaction->getUserId(),
                $transaction->getTime(),
                $transaction->getMoney()
            )
        );
    }
}