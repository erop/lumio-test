<?php

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Application\Bus\Event\EventBusInterface;
use App\Context\Shared\Application\Bus\Event\EventInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class EventBus implements EventBusInterface
{
    public function __construct(private MessageBusInterface $eventBus)
    {
    }

    public function dispatch(EventInterface $event): void
    {
        $this->eventBus->dispatch($event);
    }
}