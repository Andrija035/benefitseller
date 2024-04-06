<?php

namespace App\Entity;

use App\Enum\UserCategory;
use App\Repository\PackageRepository;
use App\Traits\Uniqueable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackageRepository::class)]
#[ORM\Table(name: 'packages')]
class Package
{
    use Uniqueable;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'packages')]
    private Company $company;

    #[ORM\Column(name: 'user_category', type: 'smallint', enumType: UserCategory::class)]
    private UserCategory $userCategory;

    #[ORM\ManyToMany(targetEntity: MerchantCategory::class, inversedBy: 'packages', cascade: ['persist'], orphanRemoval: true)]
    private Collection $merchantCategories;

    #[ORM\ManyToMany(targetEntity: Merchant::class, inversedBy: 'packages', cascade: ['persist'], orphanRemoval: true)]
    private Collection $merchants;

    public function __construct(Company $company, UserCategory $userCategory)
    {
        $this->setCompany($company);
        $this->setUserCategory($userCategory);
        $this->merchantCategories = new ArrayCollection();
        $this->merchants = new ArrayCollection();
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    public function getUserCategory(): UserCategory
    {
        return $this->userCategory;
    }

    public function setUserCategory(UserCategory $userCategory): void
    {
        $this->userCategory = $userCategory;
    }

    public function getMerchantCategories(): Collection
    {
        return $this->merchantCategories;
    }

    public function addMerchantCategory(MerchantCategory $merchantCategory): void
    {
        $this->merchantCategories[] = $merchantCategory;
    }

    public function removeMerchantCategory(MerchantCategory $merchantCategory): void
    {
        $this->merchantCategories->removeElement($merchantCategory);
    }

    public function getMerchants(): Collection
    {
        return $this->merchants;
    }

    public function addMerchant(Merchant $merchant): void
    {
        $this->merchants[] = $merchant;
    }

    public function removeMerchant(Merchant $merchant): void
    {
        $this->merchants->removeElement($merchant);
    }
}
