<?php

declare(strict_types=1);

namespace App\Client\Application\Command\UpdateClient;

use App\Client\Application\Exception\ClientNotFoundException;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use App\Core\Application\Command\CommandHandlerInterface;

readonly class UpdateClientCommandHandler implements CommandHandlerInterface
{
    public function __construct(private ClientRepositoryInterface $repository)
    {
    }

    public function __invoke(UpdateClientCommand $command): int
    {
        $client = $this->repository->findById($command->getId());

        if (is_null($client)) {
            throw new ClientNotFoundException(sprintf('Client with ID %d not found', $command->getId()));
        }

        if (null !== $command->getFirstName()) {
            $client->setFirstName($command->getFirstName());
        }

        if (null !== $command->getLastName()) {
            $client->setLastName($command->getLastName());
        }

        if (null !== $command->getAge()) {
            $client->setAge($command->getAge());
        }

        if (null !== $command->getSSN()) {
            $client->setSSN($command->getSSN());
        }

        if (null !== $command->getStreet()) {
            $client->setStreet($command->getStreet());
        }

        if (null !== $command->getCity()) {
            $client->setCity($command->getCity());
        }

        if (null !== $command->getState()) {
            $client->setState($command->getState());
        }

        if (null !== $command->getZipCode()) {
            $client->setZipCode($command->getZipCode());
        }

        if (null !== $command->getFICOCreditScore()) {
            $client->setFICOCreditScore($command->getFICOCreditScore());
        }

        if (null !== $command->getPhoneNumber()) {
            $client->setPhoneNumber($command->getPhoneNumber());
        }

        if (null !== $command->getEmail()) {
            $client->setEmail($command->getEmail());
        }

        $this->repository->update($client);

        return $client->getId();
    }
}
