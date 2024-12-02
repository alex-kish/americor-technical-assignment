<?php

declare(strict_types=1);

namespace App\Client\Application\Query\FindClientById;

use App\Core\Application\Query\QueryInterface;

readonly class FindClientByIdQuery implements QueryInterface
{
    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
