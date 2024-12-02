<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

use App\Product\Domain\DTO\LoanEligibilityResult;

readonly class PreLoanCheckResultDTO
{
    public function __construct(
        private LoanEligibilityResult $eligibility,
        private ?ProductDTO $product = null,
    ) {
    }

    /**
     * @return array{eligibility: array{is_eligible: bool, message: string, interest_rate: float}, product: ProductDTO|null}
     */
    public function toArray(): array
    {
        return [
            'eligibility' => $this->eligibility->toArray(),
            'product' => $this->product,
        ];
    }
}
