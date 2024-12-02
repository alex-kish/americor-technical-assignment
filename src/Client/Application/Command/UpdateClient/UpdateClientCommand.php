<?php

declare(strict_types=1);

namespace App\Client\Application\Command\UpdateClient;

use App\Client\Domain\ValueObject\ClientState;
use App\Core\Application\Command\CommandInterface;

readonly class UpdateClientCommand implements CommandInterface
{
    public function __construct(
        private int $id,
        private ?string $firstName,
        private ?string $lastName,
        private ?string $email,
        private ?int $age,
        private ?string $SSN,
        private ?string $street,
        private ?string $city,
        private ?ClientState $state,
        private ?string $zipCode,
        private ?int $FICOCreditScore,
        private ?string $phoneNumber,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function getSSN(): ?string
    {
        return $this->SSN;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getState(): ?ClientState
    {
        return $this->state;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function getFICOCreditScore(): ?int
    {
        return $this->FICOCreditScore;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }
}
