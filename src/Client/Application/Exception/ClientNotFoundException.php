<?php

declare(strict_types=1);

namespace App\Client\Application\Exception;

class ClientNotFoundException extends \RuntimeException
{
    public function __construct(string $message = 'Client not found', int $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
