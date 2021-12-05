<?php

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Application\Bus\Command\CommandInterface;
use App\Context\Shared\Application\Bus\Command\CommandBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements CommandBusInterface
{
    public function __construct(private MessageBusInterface $commandBus)
    {
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->commandBus->dispatch($command);
    }
}