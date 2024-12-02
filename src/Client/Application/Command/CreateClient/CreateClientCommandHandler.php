<?php

declare(strict_types=1);

namespace App\Client\Application\Command\CreateClient;

use App\Client\Domain\Factory\ClientFactory;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use App\Core\Application\Command\CommandHandlerInterface;

readonly class CreateClientCommandHandler implements CommandHandlerInterface
{
    public function __construct(private ClientRepositoryInterface $repository)
    {
    }

    public function __invoke(CreateClientCommand $command): int
    {
        $client = (new ClientFactory())->create(
            $command->getFirstName(),
            $command->getLastName(),
            $command->getAge(),
            $command->getSSN(),
            $command->getStreet(),
            $command->getCity(),
            $command->getState(),
            $command->getZipCode(),
            $command->getFICOCreditScore(),
            $command->getEmail(),
            $command->getPhoneNumber(),
        );

        $this->repository->create($client);

        return $client->getId();
    }
}
