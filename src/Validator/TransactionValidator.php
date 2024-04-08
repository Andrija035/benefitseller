<?php

namespace App\Validator;

use App\Dto\TransactionDto;
use App\Entity\Card;
use App\Entity\Merchant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TransactionValidator extends ConstraintValidator
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    /**
     * @param TransactionDto $value
     */
    public function validate($value, Constraint $constraint): void
    {
        $merchant = $this->em->getRepository(Merchant::class)->find($value->getMerchantId());

        if (!$merchant) {
            $this->context->buildViolation('Invalid merchant.')
                ->atPath('merchantId')
                ->addViolation();
        }

        $card = $this->em->getRepository(Card::class)->findOneBy(['number' => $value->getCardNumber()]);

        if (!$card) {
            $this->context->buildViolation('Invalid card provided.')
                ->atPath('cardNumber')
                ->addViolation();

            return;
        }

        if ($value->getAmount() > $card->getFunds()) {
            $this->context->buildViolation('Insufficient funds.')
                ->atPath('amount')
                ->addViolation();
        }
    }
}
