<?php

declare(strict_types=1);

namespace App\Product\Application\Exception;

class LoanDeniedException extends \RuntimeException
{
    public function __construct(string $message = 'The loan cannot be issued', int $code = 0)
    {
        parent::__construct($message, $code);
    }
}
