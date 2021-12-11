<?php

namespace App\Context\Transaction\Application\EventHandler;

use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;
use App\Context\Transaction\Domain\Event\TransactionAdded;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class ThresholdChecker implements EventHandlerInterface
{
    public function __construct(private TransactionRepositoryInterface $repository)
    {
    }

    public function __invoke(TransactionAdded $event): void
    {

    }
}