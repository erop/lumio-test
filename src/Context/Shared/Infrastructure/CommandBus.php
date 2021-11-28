<?php

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Application\Bus\Command\ICommand;
use App\Context\Shared\Application\Bus\Command\ICommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements ICommandBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatch(ICommand $command): void
    {
        $this->messageBus->dispatch($command);
    }
}