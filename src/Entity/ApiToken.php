<?php

namespace App\Entity;

use App\Traits\Timestampable;
use App\Traits\Uniqueable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity]
#[ORM\Table(name: 'api_token')]
#[UniqueEntity(fields: ['authority', 'token'])]
#[ORM\HasLifecycleCallbacks]
class ApiToken
{
    use Uniqueable;
    use Timestampable;

    public function __construct(
    #[ORM\Column(name: 'authority', type: 'string', unique: true, nullable: false)]
    private string $authority,

    #[ORM\Column(name: 'token', type: 'string', length: 255, unique: true, nullable: false)]
    private string $token,

    #[ORM\Column(name: 'active', type: 'boolean', options: ['default' => true])]
    private bool $active,
    ) {
    }

    public function getAuthority(): string
    {
        return $this->authority;
    }

    public function setAuthority(string $authority): void
    {
        $this->authority = $authority;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}
