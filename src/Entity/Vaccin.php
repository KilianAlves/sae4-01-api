<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VaccinRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VaccinRepository::class)]
#[ApiResource]
class Vaccin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRappel = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRappel(): ?\DateTimeInterface
    {
        return $this->dateRappel;
    }

    public function setDateRappel(\DateTimeInterface $dateRappel): self
    {
        $this->dateRappel = $dateRappel;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}
