<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class Transaction extends Constraint
{
    public function validatedBy(): string
    {
        return get_class($this) . 'Validator';
    }

    public function getTargets(): string
    {
        return Constraint::CLASS_CONSTRAINT;
    }
}
