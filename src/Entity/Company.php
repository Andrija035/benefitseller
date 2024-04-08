<?php

namespace App\Entity;

use App\Traits\Timestampable;
use App\Traits\Uniqueable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'companies')]
#[ORM\HasLifecycleCallbacks]
class Company
{
    use Uniqueable;
    use Timestampable;

    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'company', cascade: ['persist'], orphanRemoval: true)]
    private Collection $users;

    #[ORM\OneToMany(targetEntity: Package::class, mappedBy: 'company', cascade: ['persist'], orphanRemoval: true)]
    private Collection $packages;

    public function __construct(string $name)
    {
        $this->setName($name);
        $this->users = new ArrayCollection();
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

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function removeUser(User $user): void
    {
        $this->users->removeElement($user);
    }

    public function getPackages(): Collection
    {
        return $this->packages;
    }

    public function removePackage(Package $package): void
    {
        $this->packages->removeElement($package);
    }
}
