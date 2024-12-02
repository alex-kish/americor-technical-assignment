<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Controller;

use App\Client\Application\Command\CreateClient\CreateClientCommand;
use App\Client\Application\Command\UpdateClient\UpdateClientCommand;
use App\Client\Application\Query\FindClientById\FindClientByIdQuery;
use App\Client\Infrastructure\Request\CreateClientRequest;
use App\Client\Infrastructure\Request\UpdateClientRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class ClientController
{
    public function __construct(
        private ValidatorInterface $validator,
        private MessageBusInterface $commandBus,
        private MessageBusInterface $queryBus,
    ) {
    }

    #[Route('/api/v1/client/{id}', name: 'client_v1_view', methods: [Request::METHOD_GET])]
    public function v1View(int $id): JsonResponse
    {
        $query = new FindClientByIdQuery($id);
        $client = $this->queryBus
            ->dispatch($query)
            ->last(HandledStamp::class)
            ?->getResult();

        if (is_null($client)) {
            return new JsonResponse(['error' => 'Client not found'], 404);
        }

        return new JsonResponse(['data' => $client], 200);
    }

    #[Route('/api/v1/client', name: 'client_v1_create', methods: [Request::METHOD_POST])]
    public function v1Create(Request $request): JsonResponse
    {
        $createClientRequest = CreateClientRequest::makeFromHttpRequest($request);

        if (!$createClientRequest->validate($this->validator)) {
            return new JsonResponse([
                'status' => 'error',
                'errors' => $createClientRequest->getErrors(),
            ], 422);
        }

        $command = new CreateClientCommand(
            $createClientRequest->getFirstName(),
            $createClientRequest->getLastName(),
            $createClientRequest->getEmail(),
            $createClientRequest->getAge(),
            $createClientRequest->getSSN(),
            $createClientRequest->getStreet(),
            $createClientRequest->getCity(),
            $createClientRequest->getState(),
            $createClientRequest->getZipCode(),
            $createClientRequest->getFICOCreditScore(),
            $createClientRequest->getPhoneNumber(),
        );

        $this->commandBus->dispatch($command);

        return new JsonResponse(['status' => 'Client created'], 201);
    }

    #[Route('/api/v1/client/{id}', name: 'client_v1_update', methods: [Request::METHOD_PATCH])]
    public function v1Update(int $id, Request $request): JsonResponse
    {
        $updateClientRequest = UpdateClientRequest::makeFromHttpRequest($request);

        if (!$updateClientRequest->validate($this->validator)) {
            return new JsonResponse([
                'status' => 'error',
                'errors' => $updateClientRequest->getErrors(),
            ], 422);
        }

        $command = new UpdateClientCommand(
            $id,
            $updateClientRequest->getFirstName(),
            $updateClientRequest->getLastName(),
            $updateClientRequest->getEmail(),
            $updateClientRequest->getAge(),
            $updateClientRequest->getSSN(),
            $updateClientRequest->getStreet(),
            $updateClientRequest->getCity(),
            $updateClientRequest->getState(),
            $updateClientRequest->getZipCode(),
            $updateClientRequest->getFICOCreditScore(),
            $updateClientRequest->getPhoneNumber(),
        );

        $this->commandBus->dispatch($command);

        return new JsonResponse(['status' => 'Client updated'], 201);
    }
}
