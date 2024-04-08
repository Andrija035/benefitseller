<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

trait Uniqueable
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
