<?php

namespace App\Service;

use App\Entity\Card;
use App\Entity\Merchant;
use App\Entity\Transaction;

class TransactionService
{
    private const METHOD_SUFFIX = 'UserProcessing';

    public function __construct(
        protected readonly PackageService $packageService,
        protected readonly BenefitService $benefitService,
        protected readonly FundsService $fundsService,
    ) {
    }

    public function processTransaction(Transaction $transaction): void
    {
        $card = $transaction->getCard();
        $merchant = $transaction->getMerchant();
        $amount = $transaction->getAmount();

        $processingMethod = $card->getUser()->getCategory()->label() . self::METHOD_SUFFIX;

        $this->$processingMethod($card, $merchant, $amount);
    }

    private function standardUserProcessing(Card $card, Merchant $merchant, int $amount): void
    {
        $package = $this->packageService->getUserPackage($card->getUser());
        $merchantCategories = $package->getMerchantCategories();

        if ($merchantCategories->contains($merchant->getMerchantCategory())) {
            $this->benefitService->includeBenefits($merchant);
        }

        $this->fundsService->calculateNewBalance($card, $amount);
    }

    private function premiumUserProcessing(Card $card, Merchant $merchant, int $amount): void
    {
        $this->benefitService->includeBenefits($merchant);
        $this->fundsService->calculateNewBalance($card, $amount);
    }

    private function platinumUserProcessing(Card $card, Merchant $merchant, int $amount): void
    {
        $package = $this->packageService->getUserPackage($card->getUser());
        $merchants = $package->getMerchants();

        if ($merchants->contains($merchant)) {
            $amount = $this->fundsService->getDiscountedAmount($merchant->getDiscount(), $amount);
        }

        $this->benefitService->includeBenefits($merchant);
        $this->fundsService->calculateNewBalance($card, $amount);
    }
}
