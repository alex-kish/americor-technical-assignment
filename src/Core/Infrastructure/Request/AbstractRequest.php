<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Request;

use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRequest
{
    /**
     * @var array<string, array<string>>
     */
    private array $errors = [];

    public function validate(ValidatorInterface $validator): bool
    {
        $constraintViolations = $validator->validate($this);

        if (count($constraintViolations) > 0) {
            foreach ($constraintViolations as $violation) {
                $this->errors[$violation->getPropertyPath()][] = $violation->getMessage();
            }

            return false;
        }

        return true;
    }

    /**
     * @return array<string, array<string>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
