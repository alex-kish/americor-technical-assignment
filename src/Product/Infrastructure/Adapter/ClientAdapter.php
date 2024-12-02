<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Adapter;

use App\Client\Infrastructure\API\API;
use App\Product\Domain\DTO\ClientDTO;
use App\Product\Domain\Port\ClientProviderInterface;
use App\Product\Domain\ValueObject\ClientState;

readonly class ClientAdapter implements ClientProviderInterface
{
    public function __construct(private API $moduleClient)
    {
    }

    public function getClientById(int $id): ?ClientDTO
    {
        $source = $this->moduleClient->getClientById($id);

        if (null !== $source) {
            return new ClientDTO(
                $source->getId(),
                $source->getFirstName(),
                $source->getLastName(),
                $source->getAge(),
                $source->getSSN(),
                $source->getStreet(),
                $source->getCity(),
                ClientState::tryFrom($source->getState()),
                $source->getZipCode(),
                $source->getFICOCreditScore(),
                $source->getEmail(),
                $source->getPhoneNumber(),
            );
        }

        return null;
    }
}
