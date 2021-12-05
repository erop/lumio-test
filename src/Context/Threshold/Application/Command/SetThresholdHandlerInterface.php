<?php

namespace App\Context\Threshold\Application\Command;

use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;
use App\Context\Shared\Application\Bus\Event\IntegrationEventBusInterface;
use App\Context\Shared\Application\Bus\Event\IntegrationEventInterface;
use App\Context\Shared\Contracts\MoneyPatternConverter;
use App\Context\Shared\Integration\Event\ThresholdCreated;
use App\Context\Threshold\Domain\IThresholdRepository;
use App\Context\Threshold\Domain\Money;
use App\Context\Threshold\Domain\Threshold;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class SetThresholdHandlerInterface implements CommandHandlerInterface
{
    public function __construct(private IThresholdRepository $repository, private IntegrationEventBusInterface $integrationEventBus)
    {
    }

    public function __invoke(SetThreshold $command): void
    {
        $this->repository->save(
            $threshold = new Threshold(
                $command->getUserId(), $command->getMoney(), $command->getStartingFrom()
            )
        );
        $integrationEvent = new ThresholdCreated(
            $threshold->getId(),
            $threshold->getUserId(),
            MoneyPatternConverter::convert($threshold->getMoney(), Money::class),
            $threshold->getStartingFrom()
        );
        $this->integrationEventBus->dispatch($integrationEvent);
    }
}