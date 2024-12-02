<?php

declare(strict_types=1);

namespace App\Client\Domain\Factory;

use App\Client\Domain\Entity\Client;
use App\Client\Domain\ValueObject\ClientState;

class ClientFactory
{
    public function create(
        string $firstName,
        string $lastName,
        int $age,
        string $SSN,
        string $street,
        string $city,
        ClientState $state,
        string $zipCode,
        int $FICOCreditScore,
        string $email,
        string $phoneNumber,
    ): Client {
        $entity = new Client();

        $entity->setFirstName($firstName);
        $entity->setLastName($lastName);
        $entity->setAge($age);
        $entity->setSSN($SSN);
        $entity->setStreet($street);
        $entity->setCity($city);
        $entity->setState($state);
        $entity->setZipCode($zipCode);
        $entity->setFICOCreditScore($FICOCreditScore);
        $entity->setEmail($email);
        $entity->setPhoneNumber($phoneNumber);

        return $entity;
    }
}
