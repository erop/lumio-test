<?php

namespace App\Context\Shared\Application\Bus\Event;

interface IntegrationEventBusInterface
{
    public function dispatch(IntegrationEventInterface $integrationEvent): void;
}