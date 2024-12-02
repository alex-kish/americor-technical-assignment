<?php

declare(strict_types=1);

namespace App\Client\Application\Query\FindClientById;

use App\Client\Application\DTO\ClientDTO;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use App\Core\Application\Query\QueryHandlerInterface;

readonly class FindClientByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(private ClientRepositoryInterface $repository)
    {
    }

    public function __invoke(FindClientByIdQuery $query): ?ClientDTO
    {
        $client = $this->repository->findById($query->getId());

        return is_null($client) ? null : ClientDTO::fromEntity($client);
    }
}
