<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Request;

use App\Core\Infrastructure\Request\AbstractRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class PreLoanCheckRequest extends AbstractRequest
{
    #[Assert\NotBlank(allowNull: false)]
    #[Assert\Type('integer')]
    private mixed $clientId = null;

    #[Assert\NotBlank(allowNull: false)]
    #[Assert\Type('integer')]
    private mixed $monthlyIncome;

    public function __construct(mixed $clientId, mixed $monthlyIncome)
    {
        $this->clientId = $clientId;
        $this->monthlyIncome = $monthlyIncome;
    }

    public static function makeFromHttpRequest(Request $request): self
    {
        return new self(
            $request->query->getInt('client_id'),
            $request->query->getInt('monthly_income'),
        );
    }

    public function getClientId(): int
    {
        return (int) $this->clientId;
    }

    public function getMonthlyIncome(): int
    {
        return (int) $this->monthlyIncome;
    }
}
