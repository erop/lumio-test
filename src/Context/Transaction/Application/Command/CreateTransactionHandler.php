<?php

namespace App\Context\Transaction\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;
use App\Context\Transaction\Application\Service\OverspendingChecker;
use App\Context\Transaction\Domain\Transaction;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateTransactionHandler implements CommandHandlerInterface
{
    public function __construct(private TransactionRepositoryInterface $repository,
                                private OverspendingChecker            $checker,
                                private MessageBusInterface            $commandBus)
    {
    }

    public function __invoke(CreateTransaction $command): void
    {
        $transaction = new Transaction($userId = $command->getUserId(), $command->getMoney(), $command->getType(), $command->getTime());
        $this->repository->save($transaction);

        if ($this->checker->checkTransactions()) {

        }
    }
}