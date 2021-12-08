<?php

namespace App\Context\Transaction\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class CheckThresholdHandler implements CommandHandlerInterface
{
    public function __construct(private TransactionRepositoryInterface $repository)
    {
    }

    public function __invoke(CheckThreshold $command): void
    {
       $this->repository->findDayTransactions($command->getUserId(), $command->getDate());
    }
}