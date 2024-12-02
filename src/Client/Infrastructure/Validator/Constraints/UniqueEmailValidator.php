<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Validator\Constraints;

use App\Client\Domain\Repository\ClientRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEmailValidator extends ConstraintValidator
{
    public function __construct(private readonly ClientRepositoryInterface $clientRepository)
    {
    }

    /**
     * @param UniqueEmail $constraint
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!is_string($value) || '' === $value) {
            return;
        }

        $existingClient = $this->clientRepository->findByEmail($value);

        if (null !== $existingClient) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ email }}', $value)
                ->addViolation();
        }
    }
}
