<?php

declare(strict_types=1);

namespace App\Product\Application\Service;

use App\Product\Application\DTO\PreLoanCheckResultDTO;
use App\Product\Application\DTO\ProductDTO;
use App\Product\Application\Exception\LoanDeniedException;
use App\Product\Domain\Port\ClientProviderInterface;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Product\Domain\Service\LoanApprovalService;

readonly class PreLoanCheckService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ClientProviderInterface $clientProvider,
        private LoanApprovalService $loanApprovalService,
    ) {
    }

    public function handle(int $clientId, int $productId, int $monthlyIncome): PreLoanCheckResultDTO
    {
        $client = $this->clientProvider->getClientById($clientId);
        if (null === $client) {
            throw new LoanDeniedException('Client not found.');
        }

        $product = $this->productRepository->findById($productId);
        if (null === $product) {
            throw new LoanDeniedException('Product not found.');
        }

        $preLoanCheckResultDTO = $this->loanApprovalService->checkLoanEligibility(
            $client->getAge(),
            $client->getFicoCreditScore(),
            $client->getState()->value,
            $monthlyIncome,
            $product->getInterestRate(),
        );

        $productDTO = ProductDTO::fromEntity($product);

        return new PreLoanCheckResultDTO(
            $preLoanCheckResultDTO,
            $productDTO,
        );
    }
}
