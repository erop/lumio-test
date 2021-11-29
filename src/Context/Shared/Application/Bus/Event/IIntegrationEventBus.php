<?php

namespace App\Context\Shared\Application\Bus\Event;

interface IIntegrationEventBus
{
    public function dispatch(IntegragionEvent $event): void;
}