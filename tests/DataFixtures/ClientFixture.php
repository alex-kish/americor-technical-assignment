<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures;

use App\Client\Domain\ValueObject\ClientState;
use App\Client\Domain\Factory\ClientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Trait\FakerTrait;

class ClientFixture extends Fixture
{
    use FakerTrait;

    const REFERENCE = 'client';

    public function load(ObjectManager $manager): void
    {
        $firstName = $this->getFaker()->firstName();
        $lastName = $this->getFaker()->lastName();
        $age = $this->getFaker()->numberBetween(20, 45);
        $ssn = $this->getFaker()->bothify('#########');
        $street = $this->getFaker()->streetAddress();
        $city = $this->getFaker()->city();
        $state = ClientState::CA;
        $zip = $this->getFaker()->postcode();
        $fico = $this->getFaker()->numberBetween(300, 850);
        $phone = $this->getFaker()->e164PhoneNumber();
        $email = $this->getFaker()->email();

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

        $manager->persist($client);
        $manager->flush();

        $this->addReference(self::REFERENCE, $client);
    }
}
