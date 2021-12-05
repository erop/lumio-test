<?php

namespace App\Context\Transaction\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;
use App\Context\Transaction\Domain\Transaction;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class CreateTransactionHandler implements CommandHandlerInterface
{
    public function __construct(private TransactionRepositoryInterface $repository)
    {
    }

    public function __invoke(CreateTransaction $command): void
    {
        $transaction = new Transaction(
            $command->getUserId(),
            $command->getMoney(),
            $command->getType(),
            $command->getTime()
        );
        $this->repository->save($transaction);
    }
}