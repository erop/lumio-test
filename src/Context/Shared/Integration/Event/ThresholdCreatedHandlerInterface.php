<?php

namespace App\Context\Shared\Integration\Event;

use App\Context\Shared\Application\Bus\Event\IntegrationEventHandlerInterface;

class ThresholdCreatedHandlerInterface implements IntegrationEventHandlerInterface
{
    public function __construct()
    {
    }

    public function __invoke(ThresholdCreated $event)
    {
    }

}