<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    public const REACTIONS = [
        "Rire" => 'laugh',
        "Pleurer" => 'cry',
        "Réfléchir" => 'think',
        "Dormir" => 'sleep',
        "Rêver" => 'dream',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\Length(min:10)]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
    #[Assert\LessThanOrEqual(5)]
    private ?float $rating;

    #[ORM\Column]
    private array $reactions = [];

    #[ORM\Column]
    private ?\DateTimeImmutable $watchedAt = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Show $artWork = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getReactions(): array
    {
        return $this->reactions;
    }

    public function setReactions(array $reactions): static
    {
        $this->reactions = $reactions;

        return $this;
    }

    public function getWatchedAt(): ?\DateTimeImmutable
    {
        return $this->watchedAt;
    }

    public function setWatchedAt(\DateTimeImmutable $watchedAt): static
    {
        $this->watchedAt = $watchedAt;

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

    public function getUserName()
    {
        return $this->user->getPseudo();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

}