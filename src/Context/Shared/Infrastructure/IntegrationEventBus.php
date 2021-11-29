<?php

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Application\Bus\Event\IIntegrationEventBus;
use App\Context\Shared\Application\Bus\Event\IntegragionEvent;
use Symfony\Component\Messenger\MessageBusInterface;

class IntegrationEventBus implements IIntegrationEventBus
{

    public function __construct(private MessageBusInterface $integrationEventBus)
    {
    }

    public function dispatch(IntegragionEvent $event): void
    {
        $this->integrationEventBus->dispatch($event);
    }
}