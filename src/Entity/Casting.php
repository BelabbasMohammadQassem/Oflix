<?php

namespace App\Entity;

use App\Repository\CastingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CastingRepository::class)]
class Casting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $role = null;

    #[ORM\Column]
    private ?int $creditOrder = null;

    #[ORM\ManyToOne(inversedBy: 'castings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Actor $actor = null;

    #[ORM\ManyToOne(inversedBy: 'castings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Show $artWork = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getCreditOrder(): ?int
    {
        return $this->creditOrder;
    }

    public function setCreditOrder(int $creditOrder): static
    {
        $this->creditOrder = $creditOrder;

        return $this;
    }

    public function getActor(): ?Actor
    {
        return $this->actor;
    }

    public function setActor(?Actor $actor): static
    {
        $this->actor = $actor;

        return $this;
    }

    public function getArtWork(): ?Show
    {
        return $this->artWork;
    }

    public function setArtWork(?Show $artWork): static
    {
        $this->artWork = $artWork;

        return $this;
    }
}
