<?php

namespace App\Context\Threshold\Application\Command;

use App\Context\Shared\Application\Bus\Command\ICommandHandler;
use App\Context\Threshold\Domain\IThresholdRepository;
use App\Context\Threshold\Domain\Threshold;

class SetThresholdHandler implements ICommandHandler
{
    public function __construct(private IThresholdRepository $repository)
    {
    }

    public function __invoke(SetThreshold $command): void
    {
        $threshold = new Threshold($command->getUserId(), $command->getMoney(), new \DateTimeImmutable());
        $this->repository->save();
    }

}