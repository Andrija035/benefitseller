<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

class PackageRepository extends EntityRepository
{
    public function getUserPackage(User $user)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.company = :company AND p.userCategory = :category')
            ->setParameter('company', $user->getCompany())
            ->setParameter('category', $user->getCategory())
            ->getQuery()
            ->getSingleResult();
    }
}
