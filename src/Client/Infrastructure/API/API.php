<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\API;

use App\Client\Domain\Repository\ClientRepositoryInterface;
use App\Client\Infrastructure\DTO\ClientDTO;

readonly class API
{
    public function __construct(private ClientRepositoryInterface $clientRepository)
    {
    }

    public function getClientById(int $id): ?ClientDTO
    {
        $entity = $this->clientRepository->findById($id);

        return is_null($entity)
            ? null
            : ClientDTO::fromEntity($entity);
    }
}
