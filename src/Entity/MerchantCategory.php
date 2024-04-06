<?php

namespace App\Entity;

use App\Traits\Uniqueable;
use App\Enum\MerchantCategory as Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'merchant_categories')]
class MerchantCategory
{
    use Uniqueable;

    #[ORM\Column(name: 'category', type: 'smallint', enumType: Category::class)]
    #[Assert\NotBlank]
    private Category $category;

    #[ORM\OneToMany(targetEntity: Merchant::class, mappedBy: 'merchantCategory', cascade: ['persist'], orphanRemoval: true)]
    private Collection $merchants;

    #[ORM\ManyToMany(targetEntity: Package::class, mappedBy: 'merchantCategories')]
    private Collection $packages;

    public function __construct(Category $category)
    {
        $this->setCategory($category);
        $this->merchants = new ArrayCollection();
        $this->packages = new ArrayCollection();
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getMerchants(): Collection
    {
        return $this->merchants;
    }

    public function removeMerchant(Merchant $merchant): void
    {
        $this->merchants->removeElement($merchant);
    }

    public function getPackages(): Collection
    {
        return $this->packages;
    }
}
