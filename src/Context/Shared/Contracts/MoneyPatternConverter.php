<?php

namespace App\Context\Shared\Contracts;

class MoneyPatternConverter
{
    public static function convert(MoneyInterface $money, string $class): MoneyInterface
    {
        if (!class_exists($class)) {
            throw new \DomainException(sprintf('Class "%s" to implement "%s" does NOT exist', $class, MoneyInterface::class));
        }

        $implemented = class_implements($class);
        if (!in_array(MoneyInterface::class, $implemented)) {
            throw new \DomainException(sprintf('Class "%s" does NOT implement "%s"', $class, MoneyInterface::class));
        }

        return new $class($money->getAmount(), $money->getCurrency());
    }
}