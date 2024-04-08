<?php

namespace App\Service;

use App\Entity\Card;
use App\Entity\Package;
use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;

class TransactionService
{
    private const METHOD_SUFFIX = 'UserProcessing';

    public function __construct(
        protected readonly EntityManagerInterface $em,
    ) {
    }

    public function processTransaction(Transaction $transaction): void
    {
        $user = $transaction->getCard()->getUser();
        $processingMethod = $user->getCategory()->label() . self::METHOD_SUFFIX;

        $this->$processingMethod($transaction);
    }

    private function standardUserProcessing(Transaction $transaction): void
    {
        $card = $transaction->getCard();
        $merchant = $transaction->getMerchant();
        $amount = $transaction->getAmount();

        $package = $this->getUserPackage($card->getUser());
        $merchantCategories = $package->getMerchantCategories();

        if ($merchantCategories->contains($merchant->getMerchantCategory())) {
            // include benefits
        }

        $this->calculateNewBalance($card, $amount);
    }

    private function premiumUserProcessing(Transaction $transaction): void
    {
        $card = $transaction->getCard();
        $amount = $transaction->getAmount();

        // include benefits
        $this->calculateNewBalance($card, $amount);
    }

    private function platinumUserProcessing(Transaction $transaction): void
    {
        $card = $transaction->getCard();
        $merchant = $transaction->getMerchant();
        $amount = $transaction->getAmount();

        $package = $this->getUserPackage($card->getUser());
        $merchants = $package->getMerchants();

        if ($merchants->contains($merchant)) {
            $amount = $this->getDiscountedAmount($merchant->getDiscount(), $amount);
        }

        // include benefits
        $this->calculateNewBalance($card, $amount);
    }

    private function calculateNewBalance(Card $card, int $amount): void
    {
        $card->setFunds($card->getFunds() - $amount);
        $this->em->persist($card);
    }

    private function getDiscountedAmount(int $discount, int $amount): int
    {
        $discount = $amount * ($discount / 100);
        return $amount - $discount;
    }

    private function getUserPackage($user): Package
    {
        return $this->em->getRepository(Package::class)->getUserPackage($user);
    }
}
