<?php

declare(strict_types=1);

namespace App\Product\Domain\Port;

use App\Product\Domain\DTO\ClientDTO;

interface ClientProviderInterface
{
    public function getClientById(int $id): ?ClientDTO;
}
