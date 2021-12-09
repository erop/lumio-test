<?php

namespace App\Context\Transaction\Application\EventHandler;

use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;
use App\Context\Transaction\Domain\Event\OverspendingOccurred;

class NotifyAboutOverspending implements EventHandlerInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function __invoke(OverspendingOccurred $event)
    {
        $this->logger->info();
    }
}