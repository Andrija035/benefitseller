<?php

namespace App\Enum;

enum MerchantCategory: int
{
    case FOOD_AND_DRINKS = 1;
    case RECREATION = 2;
    case EDUCATION = 3;
    case CULTURE = 4;
    case TRAVELING = 5;
    case SHOPPING = 6;

    public function label(): string
    {
        return match ($this) {
            self::FOOD_AND_DRINKS => 'Food and drinks',
            self::RECREATION => 'Recreation',
            self::EDUCATION => 'Education',
            self::CULTURE => 'Culture',
            self::TRAVELING => 'Traveling',
            self::SHOPPING => 'Shopping',
        };
    }
}
