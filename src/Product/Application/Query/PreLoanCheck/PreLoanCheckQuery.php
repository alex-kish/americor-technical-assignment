<?php

declare(strict_types=1);

namespace App\Product\Application\Query\PreLoanCheck;

use App\Core\Application\Query\QueryInterface;

readonly class PreLoanCheckQuery implements QueryInterface
{
    public function __construct(
        private int $productId,
        private int $clientId,
        private int $monthlyIncome,
    ) {
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getMonthlyIncome(): int
    {
        return $this->monthlyIncome;
    }
}
