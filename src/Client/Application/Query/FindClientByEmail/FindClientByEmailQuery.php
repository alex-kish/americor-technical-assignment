<?php

declare(strict_types=1);

namespace App\Client\Application\Query\FindClientByEmail;

use App\Core\Application\Query\QueryInterface;

readonly class FindClientByEmailQuery implements QueryInterface
{
    public function __construct(private string $email)
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
