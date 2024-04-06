<?php

namespace App\Enum;

enum UserCategory: int
{
    case STANDARD = 1;
    case PREMIUM = 2;
    case PLATINUM = 3;

    public function label(): string
    {
        return match ($this) {
            self::STANDARD => 'Standard',
            self::PREMIUM => 'Premium',
            self::PLATINUM => 'Platinum',
        };
    }
}
