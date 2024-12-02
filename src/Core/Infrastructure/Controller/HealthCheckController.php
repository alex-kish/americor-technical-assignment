<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController
{
    #[Route('/health-check', name: 'health-check', methods: ['GET'])]
    public function healthCheck(): Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
