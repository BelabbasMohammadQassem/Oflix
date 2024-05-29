<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue()]
    private $id;

    #[Column(length: 140)]
    private $name;

    
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
}

