<?php

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Application\Bus\Command\CommandBusInterface;
use App\Context\Shared\Application\Bus\Command\CommandInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class CommandBus implements CommandBusInterface
{
    public function __construct(private MessageBusInterface $commandBus)
    {
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->commandBus->dispatch(
            (new Envelope($command))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}