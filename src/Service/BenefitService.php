<?php

namespace App\Service;

use App\Entity\Merchant;

class BenefitService
{
    public function includeBenefits(Merchant $merchant): void
    {
        $benefits = $merchant->getBenefits();

        // logic
    }
}
