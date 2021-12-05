<?php

namespace App\Context\Transaction\Presentation;

use App\Context\Shared\Application\Bus\Command\CommandBusInterface;
use App\Context\Transaction\Application\Command\CreateTransaction;
use App\Context\Transaction\Presentation\DTO\TransactionDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreditController extends AbstractController
{
    public function __construct(private SerializerInterface $serializer,
                                private CommandBusInterface $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var TransactionDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), TransactionDTO::class, 'json');
        if ('credit' !== $transactionType = $dto->getType()) {
            throw new \DomainException(sprintf('Wrong transaction type provided: "%s"', $transactionType));
        }
        $command = new CreateTransaction($dto->getUserId(), $dto->getMoney(), $transactionType, $dto->getTime());
        $this->commandBus->dispatch($command);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}