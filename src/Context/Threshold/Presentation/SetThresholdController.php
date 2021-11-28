<?php

namespace App\Context\Threshold\Presentation;

use App\Context\Shared\Application\Bus\Command\ICommandBus;
use App\Context\Shared\Domain\Money;
use App\Context\Threshold\Application\Command\SetThreshold;
use App\Context\Threshold\Presentation\DTO\ThresholdDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class SetThresholdController extends AbstractController
{
    public function __construct(private SerializerInterface $serializer, private ICommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): Response
    {
        /** @var ThresholdDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), ThresholdDTO::class, 'json');
        $money = $dto->getMoney();
        $command = new SetThreshold($dto->getUserId(), new Money($money->getAmount(), $money->getCurrency()));
        $this->commandBus->dispatch($command);
        return new Response(Response::HTTP_CREATED);
    }
}