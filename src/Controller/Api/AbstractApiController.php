<?php

namespace App\Controller\Api;

use App\Service\ApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractController implements ITokenAuthenticatedController
{
    public function __construct(
        protected readonly EntityManagerInterface $em,
        protected readonly ApiService $apiService,
    ) {
    }

    protected function successResponse(): Response
    {
        return new JsonResponse(['success' => true]);
    }
}
