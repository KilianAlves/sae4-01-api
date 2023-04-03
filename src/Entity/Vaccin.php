<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use App\Repository\VaccinRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VaccinRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(
        normalizationContext: ['groups' => ['get_Vac']], ),
    new Put(
        normalizationContext: ['groups' => ['get_Vac']],
        denormalizationContext: ['groups' => ['set_Vac']],
    ),
    new Delete(),
],
    normalizationContext: ['groups' => ['get_Vac']],
    order: ['dateRappel' => 'ASC'],
    security: "is_granted('ROLE_VETERINAIRE')")]
#[ApiFilter(OrderFilter::class, properties: ['dateRappel', 'libelle'], arguments: ['orderParameterName' => 'order'])]
#[ApiFilter(SearchFilter::class, properties: ['libelle' => 'partial', 'dateRappel' => 'partial'])]
class Vaccin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Vac', 'set_Vac'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['get_Vac', 'set_Vac'])]
    private ?\DateTimeInterface $dateRappel = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_Vac', 'set_Vac'])]
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
