<?php

namespace App\Context\Shared\Integration\Event;

use App\Context\Shared\Application\Bus\Event\IIntegrationEventHandler;

class ThresholdCreatedHandler implements IIntegrationEventHandler
{
    public function __construct()
    {
    }

    public function __invoke(ThresholdCreated $event)
    {
    }

}