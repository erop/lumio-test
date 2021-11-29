<?php

namespace App\Context\Threshold\Application\Command;

use App\Context\Shared\Application\Bus\Command\ICommandHandler;
use App\Context\Shared\Application\Bus\Event\IIntegrationEventBus;
use App\Context\Threshold\Domain\IThresholdRepository;
use App\Context\Threshold\Domain\Threshold;

class SetThresholdHandler implements ICommandHandler
{
    public function __construct(private IThresholdRepository $repository, private IIntegrationEventBus $integrationEventBus)
    {
    }

    public function __invoke(SetThreshold $command): void
    {
        $this->repository->save(
            $threshold = new Threshold(
                $command->getUserId(), $command->getMoney(), new \DateTimeImmutable()
            )
        );
        $this->integrationEventBus->dispatch(new ThresholdCreated($threshold->getId()));
    }
}