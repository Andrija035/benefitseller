<?php

namespace App\Entity;

use App\Traits\Timestampable;
use App\Traits\Uniqueable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity]
#[ORM\Table(name: 'cards')]
#[UniqueEntity(fields: ['number'])]
#[ORM\HasLifecycleCallbacks]
class Card
{
    use Uniqueable;
    use Timestampable;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'card')]
    private User $user;

    #[ORM\Column(name: 'number', type: 'string', length: 16, unique: true, nullable: false)]
    #[Assert\Length(exactly: 16)]
    #[Assert\NotBlank]
    private string $number;

    #[ORM\Column(name: 'expiration_date', type: 'datetime', nullable: false)]
    #[Assert\NotBlank]
    private \DateTime $expirationDate;

    #[ORM\Column(name: 'cvv', type: 'string', length: 5, nullable: false)]
    #[Assert\NotBlank]
    private string $cvv;

    #[ORM\Column(name: 'account', type: 'string', length: 20, nullable: false)]
    #[Assert\NotBlank]
    private string $account;

    #[ORM\Column(name: 'funds', type: 'integer', nullable: false)]
    #[Assert\NotBlank]
    private int $funds;

    #[ORM\OneToMany(targetEntity: Transaction::class, mappedBy: 'card', cascade: ['persist'], orphanRemoval: true)]
    private Collection $transactions;

    public function __construct(
        User $user,
        string $number,
        \DateTime $expirationDate,
        string $cvv,
        string $account,
        int $funds,
    ) {
        $this->setUser($user);
        $this->setNumber($number);
        $this->setExpirationDate($expirationDate);
        $this->setCvv($cvv);
        $this->setAccount($account);
        $this->setFunds($funds);
        $this->transactions = new ArrayCollection();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getExpirationDate(): \DateTime
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTime $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): void
    {
        $this->cvv = $cvv;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    public function setAccount(string $account): void
    {
        $this->account = $account;
    }

    public function getFunds(): int
    {
        return $this->funds;
    }

    public function setFunds(int $funds): void
    {
        $this->funds = $funds;
    }

    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function removeTransaction(Transaction $transaction): void
    {
        $this->transactions->removeElement($transaction);
    }
}
