<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CreneauRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CreneauRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(
        normalizationContext: ['groups' => ['get_Creneau']], ),
    new Put(
        normalizationContext: ['groups' => ['get_Creneau']],
        denormalizationContext: ['groups' => ['set_Creneau']],
    ),
    new Patch(
        normalizationContext: ['groups' => ['get_Creneau']],
        denormalizationContext: ['groups' => ['set_Creneau']],
    ),
    new Post(
        normalizationContext: ['groups' => ['get_Creneau']],
        denormalizationContext: ['groups' => ['set_Creneau']],
    ),
    new Delete(),
],
    normalizationContext: ['groups' => ['get_Creneau']],
    security: "is_granted('ROLE_VETERINAIRE')")]
class Creneau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Creneau'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['get_Creneau', 'set_Creneau'])]
    private ?float $debut = null;

    #[ORM\Column]
    #[Groups(['get_Creneau', 'set_Creneau'])]
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
