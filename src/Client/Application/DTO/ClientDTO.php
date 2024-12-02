<?php

declare(strict_types=1);

namespace App\Client\Application\DTO;

use App\Client\Domain\Entity\Client;

class ClientDTO
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {
    }

    public static function fromEntity(Client $entity): self
    {
        return new self(
            $entity->getId(),
            $entity->getFirstName(),
            $entity->getLastName(),
            $entity->getEmail(),
        );
    }
}
