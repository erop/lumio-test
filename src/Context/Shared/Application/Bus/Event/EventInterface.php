<?php

namespace App\Context\Shared\Application\Bus\Event;

interface EventInterface
{
    public function occurredAt(): \DateTimeImmutable;
}