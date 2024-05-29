<?php

namespace App\Entity;

use App\Repository\NameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NameRepository::class)]
class Name
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $string = null;

    #[ORM\Column(length: 255)]
    private ?string $actor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getString(): ?string
    {
        return $this->string;
    }

    public function setString(?string $string): static
    {
        $this->string = $string;

        return $this;
    }

    public function getActor(): ?string
    {
        return $this->actor;
    }

    public function setActor(string $actor): static
    {
        $this->actor = $actor;

        return $this;
    }
}
