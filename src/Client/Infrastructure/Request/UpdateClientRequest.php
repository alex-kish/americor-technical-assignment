<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Request;

use App\Client\Domain\ValueObject\ClientState;
use App\Client\Infrastructure\Validator\Constraints\UniqueEmail;
use App\Core\Infrastructure\Request\AbstractRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateClientRequest extends AbstractRequest
{
    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Length(
        min: 2,
        max: 128,
        minMessage: 'Your last name must be at least {{ limit }} characters long',
        maxMessage: 'Your last name cannot be longer than {{ limit }} characters',
    )]
    private mixed $firstName = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Length(
        min: 2,
        max: 128,
        minMessage: 'Your last name must be at least {{ limit }} characters long',
        maxMessage: 'Your last name cannot be longer than {{ limit }} characters',
    )]
    private mixed $lastName = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Your email must be at least {{ limit }} characters long',
        maxMessage: 'Your email name cannot be longer than {{ limit }} characters',
    )]
    #[Assert\Email]
    #[UniqueEmail]
    private mixed $email = null;

    #[Assert\Range(
        min: 18,
        max: 100,
        notInRangeMessage: 'Age must be between {{ min }} and {{ max }} years old',
    )]
    private mixed $age = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Regex(
        pattern: '/^\d{9}$/',
        message: 'SSN must be exactly 9 digits',
    )]
    private mixed $SSN = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Length(max: 255)]
    private mixed $street = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Length(max: 255)]
    private mixed $city = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Choice(callback: [ClientState::class, 'getValues'])]
    private mixed $state = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Regex(
        pattern: '/^\d{5}(-\d{4})?$/',
        message: 'ZIP code must be valid (e.g., 12345 or 12345-6789)',
    )]
    private mixed $zipCode = null;

    #[Assert\Range(
        notInRangeMessage: 'FICO credit score must be between {{ min }} and {{ max }}',
        min: 300,
        max: 850,
    )]
    private mixed $FICOCreditScore = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Regex(
        pattern: '/^\+?[0-9]{10,15}$/',
        message: 'Phone number must be valid',
    )]
    private mixed $phoneNumber = null;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        $this->firstName = $data['first_name'] ?? null;
        $this->lastName = $data['last_name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->age = $data['age'] ?? null;
        $this->SSN = $data['ssn'] ?? null;
        $this->street = $data['street'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->state = $data['state'] ?? null;
        $this->zipCode = $data['zip_code'] ?? null;
        $this->FICOCreditScore = $data['fico_credit_score'] ?? null;
        $this->phoneNumber = $data['phone_number'] ?? null;
    }

    public static function makeFromHttpRequest(Request $request): self
    {
        return new self($request->request->all());
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
        return is_numeric($this->age)
            ? (int) $this->age
            : null;
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
        return is_string($this->state)
            ? ClientState::tryFrom($this->state)
            : null;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function getFICOCreditScore(): ?int
    {
        return is_numeric($this->FICOCreditScore)
            ? (int) $this->FICOCreditScore
            : null;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }
}
