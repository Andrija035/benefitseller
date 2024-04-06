<?php

namespace App\Entity;

use App\Traits\Uniqueable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'merchants')]
class Merchant
{
    use Uniqueable;

    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\Column(name: 'discount', type: 'integer', nullable: false)]
    #[Assert\NotBlank]
    private int $discount;

    #[ORM\ManyToOne(targetEntity: MerchantCategory::class, inversedBy: 'merchants')]
    #[ORM\JoinColumn(nullable: false)]
    private MerchantCategory $merchantCategory;

    #[ORM\ManyToMany(targetEntity: Package::class, mappedBy: 'merchants')]
    private Collection $packages;

    public function __construct(string $name, int $discount, MerchantCategory $merchantCategory)
    {
        $this->setName($name);
        $this->setDiscount($discount);
        $this->setMerchantCategory($merchantCategory);
        $this->packages = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): void
    {
        $this->discount = $discount;
    }

    public function getMerchantCategory(): MerchantCategory
    {
        return $this->merchantCategory;
    }

    public function setMerchantCategory(MerchantCategory $merchantCategory): void
    {
        $this->merchantCategory = $merchantCategory;
    }

    public function getPackages(): Collection
    {
        return $this->packages;
    }
}
