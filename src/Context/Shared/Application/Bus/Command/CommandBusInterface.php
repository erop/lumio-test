<?php

namespace App\Context\Shared\Application\Bus\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}