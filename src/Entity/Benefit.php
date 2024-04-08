<?php

namespace App\Entity;

use App\Traits\Timestampable;
use App\Traits\Uniqueable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'benefits')]
#[ORM\HasLifecycleCallbacks]
class Benefit
{
    use Uniqueable;
    use Timestampable;

    public function __construct(
    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank]
    private string $name,

    #[ORM\Column(name: 'type', type: 'integer', nullable: false)]
    #[Assert\NotBlank]
    private int $type,

    #[ORM\ManyToOne(targetEntity: Merchant::class, inversedBy: 'benefits')]
    #[ORM\JoinColumn(nullable: false)]
    private Merchant $merchant,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getMerchant(): Merchant
    {
        return $this->merchant;
    }

    public function setMerchant(Merchant $merchant): void
    {
        $this->merchant = $merchant;
    }
}
