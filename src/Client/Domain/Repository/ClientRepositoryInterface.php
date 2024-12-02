<?php

declare(strict_types=1);

namespace App\Client\Domain\Repository;

use App\Client\Domain\Entity\Client;

interface ClientRepositoryInterface
{
    public function create(Client $client): void;

    public function update(Client $client): void;

    public function findById(int $id): ?Client;

    public function findByEmail(string $email): ?Client;
}
