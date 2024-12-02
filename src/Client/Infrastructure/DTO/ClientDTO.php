<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\DTO;

use App\Client\Domain\Entity\Client;

readonly class ClientDTO
{
    public function __construct(
        private int $id,
        private string $firstName,
        private string $lastName,
        private int $age,
        private string $SSN,
        private string $street,
        private string $city,
        private string $state,
        private string $zipCode,
        private int $FICOCreditScore,
        private string $email,
        private string $phoneNumber,
    ) {
    }

    public static function fromEntity(Client $entity): self
    {
        return new self(
            $entity->getId(),
            $entity->getFirstName(),
            $entity->getLastName(),
            $entity->getAge(),
            $entity->getSSN(),
            $entity->getStreet(),
            $entity->getCity(),
            $entity->getState()->value,
            $entity->getZipCode(),
            $entity->getFICOCreditScore(),
            $entity->getEmail(),
            $entity->getPhoneNumber(),
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getSSN(): string
    {
        return $this->SSN;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getFICOCreditScore(): int
    {
        return $this->FICOCreditScore;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
