<?php

namespace App\Controller\Api;

use App\Dto\TransactionDto;
use App\Service\Factory\TransactionFactoryService;
use App\Service\TransactionService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api')]
class TransactionApiController extends AbstractApiController
{
    #[Route(path: '/transaction', methods: ['POST'])]
    public function importConferences(
        #[MapRequestPayload(resolver: 'transaction')]
        TransactionDto $transactionDto,
        TransactionFactoryService $transactionFactory,
        TransactionService $transactionService,
    ): Response {
        $transaction = $transactionFactory->createTransactionFromDto($transactionDto);
        $this->em->persist($transaction);

        $transactionService->processTransaction($transaction);

        $this->em->flush();
        $this->em->clear();

        return $this->successResponse();
    }
}
