<?php

namespace App\Context\Shared\Application\Bus\Event;

interface EventBusInterface
{
    public function dispatch(EventInterface $event): void;
}