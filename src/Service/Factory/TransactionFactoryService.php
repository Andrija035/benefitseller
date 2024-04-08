<?php

namespace App\Service\Factory;

use App\Dto\TransactionDto;
use App\Entity\Card;
use App\Entity\Merchant;
use App\Entity\Transaction;

class TransactionFactoryService extends AbstractFactoryService
{
    public function createTransactionFromDto(TransactionDto $transactionDto): Transaction
    {
        $card = $this->em->getRepository(Card::class)->findOneBy(['number' => $transactionDto->getCardNumber()]);
        $merchant = $this->em->getRepository(Merchant::class)->find($transactionDto->getMerchantId());
        $amount = $transactionDto->getAmount();

        return new Transaction($card, $merchant, $amount);
    }
}
