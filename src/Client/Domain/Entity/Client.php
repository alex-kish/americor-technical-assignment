<?php

namespace App\Client\Domain\Entity;

use App\Client\Domain\Repository\ClientRepositoryInterface;
use App\Client\Domain\ValueObject\ClientState;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepositoryInterface::class)]
#[ORM\Table(name: 'client', uniqueConstraints: [
    new ORM\UniqueConstraint(name: 'client_email_uniq', columns: ['email']),
])]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /* @phpstan-ignore-next-line property.unusedType */
    private ?int $id = null;

    #[ORM\Column(name: 'first_name', length: 128)]
    private ?string $firstName = null;

    #[ORM\Column(name: 'last_name', length: 128)]
    private ?string $lastName = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $age = null;

    #[ORM\Column(name: 'ssn', length: 9)]
    private ?string $SSN = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(enumType: ClientState::class)]
    private ?ClientState $state = null;

    #[ORM\Column(name: 'zip_code', length: 10)]
    private ?string $zipCode = null;

    #[ORM\Column(name: 'fico_credit_score', type: Types::SMALLINT)]
    private ?int $FICOCreditScore = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(name: 'phone_number', length: 15)]
    private ?string $phoneNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getSSN(): ?string
    {
        return $this->SSN;
    }

    public function setSSN(string $SSN): static
    {
        $this->SSN = $SSN;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?ClientState
    {
        return $this->state;
    }

    public function setState(ClientState $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getFICOCreditScore(): ?int
    {
        return $this->FICOCreditScore;
    }

    public function setFICOCreditScore(int $FICOCreditScore): static
    {
        $this->FICOCreditScore = $FICOCreditScore;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
