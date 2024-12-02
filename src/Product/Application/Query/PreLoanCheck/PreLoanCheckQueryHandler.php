<?php

declare(strict_types=1);

namespace App\Product\Application\Query\PreLoanCheck;

use App\Core\Application\Query\QueryHandlerInterface;
use App\Product\Application\DTO\PreLoanCheckResultDTO;
use App\Product\Application\Exception\LoanDeniedException;
use App\Product\Application\Service\PreLoanCheckService;
use App\Product\Domain\DTO\LoanEligibilityResult;

readonly class PreLoanCheckQueryHandler implements QueryHandlerInterface
{
    public function __construct(private PreLoanCheckService $preLoanCheck)
    {
    }

    public function __invoke(PreLoanCheckQuery $query): PreLoanCheckResultDTO
    {
        try {
            return $this->preLoanCheck->handle(
                $query->getClientId(),
                $query->getProductId(),
                $query->getMonthlyIncome(),
            );
        } catch (LoanDeniedException $exception) {
            return new PreLoanCheckResultDTO(
                new LoanEligibilityResult(false, $exception->getMessage(), 0),
                null
            );
        }
    }
}
