<?php

declare(strict_types=1);

namespace App\Product\Domain\Service;

use App\Product\Domain\DTO\LoanEligibilityResult;

readonly class LoanApprovalService
{
    private const MIN_AGE = 18;
    private const MAX_AGE = 60;
    private const MIN_INCOME = 1000;
    private const MIN_CREDIT_SCORE = 500;
    private const STATES_ELIGIBLE_FOR_LOAN = ['CA', 'NY', 'NV'];

    private const INTEREST_RATE_INCREASE = 1149;

    public function checkLoanEligibility(
        int $age,
        int $FICOCreditScore,
        string $state,
        int $monthlyIncome,
        float $interestRate,
    ): LoanEligibilityResult {
        if ($FICOCreditScore < self::MIN_CREDIT_SCORE) {
            return new LoanEligibilityResult(
                false,
                'Low credit rating.',
            );
        }

        if ($monthlyIncome < self::MIN_INCOME) {
            return new LoanEligibilityResult(
                false,
                'Insufficient monthly income.',
            );
        }

        if ($age < self::MIN_AGE || $age > self::MAX_AGE) {
            return new LoanEligibilityResult(
                false,
                'The client must be between 18 and 60 years old.',
            );
        }

        if (!in_array($state, self::STATES_ELIGIBLE_FOR_LOAN, true)) {
            return new LoanEligibilityResult(
                false,
                'Loans are issued only in the states of CA, NY, NV.',
            );
        }

        if ('NY' === $state) {
            $randomDecision = rand(0, 1);
            if (0 === $randomDecision) {
                return new LoanEligibilityResult(
                    false,
                    'Loan for NY customer rejected randomly.',
                );
            }
        }

        if ('CA' === $state) {
            $interestRate += self::INTEREST_RATE_INCREASE;
        }

        return new LoanEligibilityResult(true, 'The loan has been approved.', $interestRate);
    }
}
