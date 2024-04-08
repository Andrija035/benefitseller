<?php

namespace App\Service;

use App\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;

class FundsService
{
    public function __construct(
        protected readonly EntityManagerInterface $em,
    ) {
    }

    public function calculateNewBalance(Card $card, int $amount): void
    {
        $card->setFunds($card->getFunds() - $amount);
        $this->em->persist($card);
    }

    public function getDiscountedAmount(int $discount, int $amount): int
    {
        $discount = $amount * ($discount / 100);

        return $amount - floor($discount);
    }
}
