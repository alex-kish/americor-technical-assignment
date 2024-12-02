<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Controller;

use App\Product\Application\Query\PreLoanCheck\PreLoanCheckQuery;
use App\Product\Infrastructure\Request\PreLoanCheckRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class ProductController
{
    public function __construct(
        private ValidatorInterface $validator,
        private MessageBusInterface $queryBus,
    ) {
    }

    #[Route('/api/v1/product/{productId}/pre-loan-check', name: 'product_v1_pre_loan_check', methods: [Request::METHOD_GET])]
    public function v1PreLoanCheck(int $productId, Request $request): JsonResponse
    {
        $preLoanCheckRequest = PreLoanCheckRequest::makeFromHttpRequest($request);

        if (!$preLoanCheckRequest->validate($this->validator)) {
            return new JsonResponse([
                'status' => 'error',
                'errors' => $preLoanCheckRequest->getErrors(),
            ], 422);
        }

        $query = new PreLoanCheckQuery($productId, $preLoanCheckRequest->getClientId(), $preLoanCheckRequest->getMonthlyIncome());

        $result = $this->queryBus
            ->dispatch($query)
            ->last(HandledStamp::class)
            ?->getResult();

        return new JsonResponse(['data' => $result->toArray()], 200);
    }

    #[Route('/api/v1/product/{productId}/issue-loan', name: 'product_v1_issue_loan', methods: [Request::METHOD_POST])]
    public function issueLoan(int $productId, Request $request): JsonResponse
    {
        return new JsonResponse(['data' => ['Not implemented']], 201);
    }
}
