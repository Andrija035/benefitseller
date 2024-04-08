<?php

namespace App\Entity;

use App\Enum\UserCategory;
use App\Traits\Timestampable;
use App\Traits\Uniqueable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[UniqueEntity(fields: ['email'])]
#[ORM\HasLifecycleCallbacks]
class User
{
    use Uniqueable;
    use Timestampable;

    #[ORM\OneToOne(targetEntity: Card::class, mappedBy: 'user')]
    private Card $card;

    public function __construct(
    #[ORM\Column(name: 'email', type: 'string', length: 255, unique: true, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email,

    #[ORM\Column(name: 'firstname', type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank]
    private string $firstname,

    #[ORM\Column(name: 'lastname', type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank]
    private string $lastname,

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private Company $company,

    #[ORM\Column(name: 'category', type: 'smallint', enumType: UserCategory::class, options: ['default' => UserCategory::STANDARD])]
    private UserCategory $category = UserCategory::STANDARD,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getCategory(): UserCategory
    {
        return $this->category;
    }

    public function setCategory(UserCategory $category): void
    {
        $this->category = $category;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(Card $card): void
    {
        $this->card = $card;
    }

    public function isStandardUser(): bool
    {
        return $this->getCategory() == UserCategory::STANDARD;
    }

    public function isPremiumUser(): bool
    {
        return $this->getCategory() == UserCategory::PREMIUM;
    }

    public function isPlatinumUser(): bool
    {
        return $this->getCategory() == UserCategory::PLATINUM;
    }
}
