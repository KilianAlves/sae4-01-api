<?php

namespace App\Entity;

use App\Repository\CreaneauRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreaneauRepository::class)]
class Creaneau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $debut = null;

    #[ORM\Column]
    private ?float $fin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?float
    {
        return $this->debut;
    }

    public function setDebut(float $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?float
    {
        return $this->fin;
    }

    public function setFin(float $fin): self
    {
        $this->fin = $fin;

        return $this;
    }
}
