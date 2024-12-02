<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Request;

use App\Client\Domain\ValueObject\ClientState;
use App\Client\Infrastructure\Validator\Constraints\UniqueEmail;
use App\Core\Infrastructure\Request\AbstractRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class CreateClientRequest extends AbstractRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 128,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private mixed $firstName;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 128,
        minMessage: 'Your last name must be at least {{ limit }} characters long',
        maxMessage: 'Your last name cannot be longer than {{ limit }} characters',
    )]
    private mixed $lastName;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Your email must be at least {{ limit }} characters long',
        maxMessage: 'Your email name cannot be longer than {{ limit }} characters',
    )]
    #[Assert\Email]
    #[UniqueEmail]
    private mixed $email;

    #[Assert\NotBlank]
    #[Assert\Range(
        min: 18,
        max: 100,
        notInRangeMessage: 'Age must be between {{ min }} and {{ max }} years old',
    )]
    private mixed $age;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{9}$/',
        message: 'SSN must be exactly 9 digits',
    )]
    private mixed $SSN;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private mixed $street;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private mixed $city;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [ClientState::class, 'getValues'])]
    private mixed $state;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{5}(-\d{4})?$/',
        message: 'ZIP code must be valid (e.g., 12345 or 12345-6789)',
    )]
    private mixed $zipCode;

    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: 'FICO credit score must be between {{ min }} and {{ max }}',
        min: 300,
        max: 850,
    )]
    private mixed $FICOCreditScore;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\+?[0-9]{10,15}$/',
        message: 'Phone number must be valid',
    )]
    private mixed $phoneNumber;

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

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAge(): int
    {
        return (int) $this->age;
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

    public function getState(): ClientState
    {
        return ClientState::from($this->state);
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getFICOCreditScore(): int
    {
        return (int) $this->FICOCreditScore;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
