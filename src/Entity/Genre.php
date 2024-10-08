<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue()]
    #[Groups([
        'genre_browse',
        'show_browse',
    ])]
    private $id;

    #[Column(length: 140)]
    #[Groups([
        'genre_browse',
        'show_browse',
    ])]
    #[Assert\Length(min: 2)]
    private $name;

    /**
     * @var Collection<int, Show>
     */
    #[ORM\ManyToMany(targetEntity: Show::class, mappedBy: 'genres')]
    #[Groups([
        'genre_browse',
    ])]
    private Collection $shows;

    public function __construct()
    {
        $this->shows = new ArrayCollection();
    }

    
    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name) :void
    {
        $this->name = $name;
    }

    /**
     * @return Collection<int, Show>
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(Show $show): static
    {
        if (!$this->shows->contains($show)) {
            $this->shows->add($show);
            $show->addGenre($this);
        }

        return $this;
    }

    public function removeShow(Show $show): static
    {
        if ($this->shows->removeElement($show)) {
            $show->removeGenre($this);
        }

        return $this;
    }
}

