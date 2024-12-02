<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

use App\Product\Domain\Entity\Product;

readonly class ProductDTO
{
    public function __construct(
        public string $name,
        public int $term,
        public int $rate,
        public int $amount,
    ) {
    }

    public static function fromEntity(Product $entity): self
    {
        return new self(
            $entity->getProductName(),
            $entity->getLoanTerm(),
            $entity->getInterestRate(),
            $entity->getLoanAmount(),
        );
    }
}
