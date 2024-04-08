<?php

namespace App\Controller\Api;

use App\Dto\TransactionDto;
use App\Service\Factory\TransactionFactoryService;
use App\Service\TransactionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api')]
class TransactionApiController extends AbstractController
{
    #[Route(path: '/transaction', methods: ['POST'])]
    public function importConferences(
        #[MapRequestPayload(resolver: 'transaction')]
        TransactionDto $transactionDto,
        TransactionFactoryService $transactionFactory,
        TransactionService $transactionService,
        EntityManagerInterface $em,
    ): Response {
        $transaction = $transactionFactory->createTransactionFromDto($transactionDto);
        $em->persist($transaction);

        $transactionService->processTransaction($transaction);

        $em->flush();
        $em->clear();

        return new JsonResponse('success');
    }
}
