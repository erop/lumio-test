<?php

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Application\Bus\Event\IntegrationEventBusInterface;
use App\Context\Shared\Application\Bus\Event\IntegrationEventInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class IntegrationEventBus implements IntegrationEventBusInterface
{

    public function __construct(private MessageBusInterface $integrationEventBus)
    {
    }

    public function dispatch(IntegrationEventInterface $integrationEvent): void
    {
        $this->integrationEventBus->dispatch(
            (new Envelope($integrationEvent))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}