<?php

namespace App\Service\Factory;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractFactoryService
{
    public function __construct(
        protected readonly EntityManagerInterface $em,
    ) {
    }
}
