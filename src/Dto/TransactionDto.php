<?php

namespace App\Dto;

use App\Validator as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;

#[CustomAssert\Transaction]
class TransactionDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(exactly: 16)]
        private readonly string $cardNumber,
        #[Assert\NotBlank]
        private readonly int $merchantId,
        #[Assert\NotBlank]
        #[Assert\NotEqualTo(0)]
        private readonly int $amount,
    ) {
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function getMerchantId(): int
    {
        return $this->merchantId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
