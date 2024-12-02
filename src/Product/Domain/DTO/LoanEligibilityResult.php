<?php

declare(strict_types=1);

namespace App\Product\Domain\DTO;

readonly class LoanEligibilityResult
{
    public function __construct(private bool $isEligible, private string $message, private float $interestRate = 0)
    {
    }

    /**
     * @return array{is_eligible: bool, message: string, interest_rate: float}
     */
    public function toArray(): array
    {
        return [
            'is_eligible' => $this->isEligible,
            'message' => $this->message,
            'interest_rate' => $this->interestRate,
        ];
    }
}
