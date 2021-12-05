<?php

namespace App\Context\Shared\Integration\Event;

use App\Context\Shared\Application\Bus\Event\IntegrationEventHandlerInterface;

class ThresholdCreatedHandler implements IntegrationEventHandlerInterface
{
    public function __construct()
    {
    }

    public function __invoke(ThresholdCreated $event)
    {
    }

}