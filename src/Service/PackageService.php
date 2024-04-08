<?php

namespace App\Service;

use App\Entity\Package;
use Doctrine\ORM\EntityManagerInterface;

class PackageService
{
    public function __construct(
        protected readonly EntityManagerInterface $em,
    ) {
    }

    public function getUserPackage($user): Package
    {
        return $this->em->getRepository(Package::class)->getUserPackage($user);
    }
}
