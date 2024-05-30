<?php

namespace App\Entity;

use App\Repository\CastingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CastingRepository::class)]
class Casting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $creditOrder = null;

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

    public function setCreditOrder(int $credit_order): static
    {
        $this->creditOrder = $credit_order;

        return $this;
    }
}
