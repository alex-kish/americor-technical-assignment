<?php

namespace App\Product\Domain\Entity;

use App\Product\Domain\Repository\ProductRepositoryInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepositoryInterface::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /* @phpstan-ignore-next-line property.unusedType */
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $productName = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $loanTerm = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $interestRate = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $loanAmount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): static
    {
        $this->productName = $productName;

        return $this;
    }

    public function getLoanTerm(): ?int
    {
        return $this->loanTerm;
    }

    public function setLoanTerm(int $loanTerm): static
    {
        $this->loanTerm = $loanTerm;

        return $this;
    }

    public function getInterestRate(): ?int
    {
        return $this->interestRate;
    }

    public function setInterestRate(int $interestRate): static
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    public function getLoanAmount(): ?int
    {
        return $this->loanAmount;
    }

    public function setLoanAmount(int $loanAmount): static
    {
        $this->loanAmount = $loanAmount;

        return $this;
    }
}
