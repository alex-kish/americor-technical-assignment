<?php

declare(strict_types=1);

namespace App\Client\Application\Query\FindClientByEmail;

use App\Client\Application\DTO\ClientDTO;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use App\Core\Application\Query\QueryHandlerInterface;

readonly class FindClientByEmailQueryHandler implements QueryHandlerInterface
{
    public function __construct(private ClientRepositoryInterface $repository)
    {
    }

    public function __invoke(FindClientByEmailQuery $query): ?ClientDTO
    {
        $client = $this->repository->findByEmail($query->getEmail());

        return is_null($client) ? null : ClientDTO::fromEntity($client);
    }
}
