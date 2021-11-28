<?php

namespace App\Context\Shared\Application\Bus\Query;

interface IQueryBus
{
    public function ask(IQuery $query): IQueryResult;
}