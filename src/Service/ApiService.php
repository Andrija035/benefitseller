<?php

namespace App\Service;

use App\Entity\ApiToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    final public function checkCredentials(Request $request): bool
    {
        $apiToken = $this->em->getRepository(ApiToken::class)->findOneBy([
            'authority' => $request->headers->get('authority'),
            'token' => $request->headers->get('token'),
            'active' => true,
        ]);

        if ($apiToken) {
            return true;
        }

        return false;
    }
}
