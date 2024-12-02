<?php

namespace Functional\Client\Infrastructure\Repository;

use App\Client\Domain\ValueObject\ClientState;
use App\Client\Domain\Factory\ClientFactory;
use App\Client\Infrastructure\Repository\ClientRepository;
use Faker\Generator;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientRepositoryTest extends WebTestCase
{
    private ClientRepository $repository;

    private Generator $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = static::getContainer()->get(ClientRepository::class);
        $this->faker = Factory::create();
    }

    public function testClientCreatedSuccessfully(): void
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        $age = $this->faker->numberBetween(20, 45);
        $ssn = $this->faker->bothify('#########');
        $street = $this->faker->streetAddress();
        $city = $this->faker->city();
        $state = ClientState::CA;
        $zip = $this->faker->postcode();
        $fico = $this->faker->numberBetween(300, 850);
        $phone = $this->faker->e164PhoneNumber();
        $email = $this->faker->email();

        $client = (new ClientFactory())->create(
            $firstName,
            $lastName,
            $age,
            $ssn,
            $street,
            $city,
            $state,
            $zip,
            $fico,
            $email,
            $phone,
        );

        $this->repository->create($client);

        $existingClient = $this->repository->findById($client->getId());

        $this->assertEquals($existingClient?->getId(), $client->getId());
    }
}
