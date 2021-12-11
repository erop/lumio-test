<?php

namespace App\Context\Transaction\Application\EventHandler;

use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;
use App\Context\Transaction\Domain\Event\TransactionAdded;

class CheckThresholdOnTransaction implements EventHandlerInterface
{
    public function __construct()
    {
    }

    public function __invoke(TransactionAdded $event): void
    {
        // todo get all transactions for a given day: TransactionRepository
        // todo calculate transaction money for selected transactions: TransactionService -> put a collection there and receive the money
        // todo get threshold for a give date
        // todo calculate Overspending
        // todo if Overspending->amount > 0 write to the log
    }
}