<?php

namespace App\Entity;

use App\Traits\Timestampable;
use App\Traits\Uniqueable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'transactions')]
#[ORM\HasLifecycleCallbacks]
class Transaction
{
    use Uniqueable;
    use Timestampable;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Card::class, inversedBy: 'transactions')]
        #[ORM\JoinColumn(nullable: false)]
        private Card $card,

        #[ORM\ManyToOne(targetEntity: Merchant::class, inversedBy: 'transactions')]
        #[ORM\JoinColumn(nullable: false)]
        private Merchant $merchant,

        #[ORM\Column(name: 'amount', type: 'integer', nullable: false)]
        #[Assert\NotBlank]
        private int $amount,
    ) {
    }
    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(Card $card): void
    {
        $this->card = $card;
    }

    public function getMerchant(): Merchant
    {
        return $this->merchant;
    }

    public function setMerchant(Merchant $merchant): void
    {
        $this->merchant = $merchant;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }
}
