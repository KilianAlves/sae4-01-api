<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDeces = null;

    #[ORM\Column(length: 50)]
    private ?string $robe = null;

    #[ORM\Column(length: 50)]
    private ?string $numPuce = null;

    #[ORM\Column(length: 256)]
    private ?string $commentaire = null;

    #[ORM\Column]
    private ?float $poids = null;

    #[ORM\Column(length: 50)]
    private ?string $numTatouage = null;

    #[ORM\Column]
    private ?int $aDisparu = null;

    #[ORM\Column]
    private ?int $estAgressif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    public function getRobe(): ?string
    {
        return $this->robe;
    }

    public function setRobe(string $robe): self
    {
        $this->robe = $robe;

        return $this;
    }

    public function getNumPuce(): ?string
    {
        return $this->numPuce;
    }

    public function setNumPuce(string $numPuce): self
    {
        $this->numPuce = $numPuce;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getNumTatouage(): ?string
    {
        return $this->numTatouage;
    }

    public function setNumTatouage(string $numTatouage): self
    {
        $this->numTatouage = $numTatouage;

        return $this;
    }

    public function getADisparu(): ?int
    {
        return $this->aDisparu;
    }

    public function setADisparu(int $aDisparu): self
    {
        $this->aDisparu = $aDisparu;

        return $this;
    }

    public function getEstAgressif(): ?int
    {
        return $this->estAgressif;
    }

    public function setEstAgressif(int $estAgressif): self
    {
        $this->estAgressif = $estAgressif;

        return $this;
    }
}
