<?php

namespace App\Context\Shared\Application\Bus\Command;

interface ICommandBus
{
    public function dispatch(ICommand $command): void;
}