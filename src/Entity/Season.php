<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([
        'show_browse', 
    ])]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups([
        'show_browse', 
    ])]
    private ?int $number = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups([
        'show_browse', 
    ])]
    private ?int $episodeCount = null;

    #[ORM\ManyToOne(inversedBy: 'seasons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Show $tvShow = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getEpisodeCount(): ?int
    {
        return $this->episodeCount;
    }

    public function setEpisodeCount(int $episodeCount): static
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    public function getTvShow(): ?Show
    {
        return $this->tvShow;
    }

    public function setTvShow(?Show $tvShow): static
    {
        $this->tvShow = $tvShow;

        return $this;
    }
}
