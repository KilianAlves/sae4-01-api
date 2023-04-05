<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\CreateRendezVousController;
use App\Controller\RendezVousController;
use App\Repository\RendezVousRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
#[ApiResource(operations: [
    new Post(),
//    new Post(
//        name: 'create',
//        uriTemplate: '/rendez_vouses',
//        controller: CreateRendezVousController::class
//    ),
    new GetCollection(
        uriTemplate: '/rendez_vouse/semaine/{id}',
        controller: RendezVousController::class,
    ),
])]
class rendez_vous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $motif = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRdv = null;

    #[ORM\Column]
    private ?int $estUrgent = null;

    #[ORM\Column(length: 50)]
    private ?string $commentaireVeto = null;

    #[ORM\Column]
    private ?int $estDomicile = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVous')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVous')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Veterinaire $veterinaire = null;

    #[ORM\Column]
    private ?int $horaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getDateRdv(): ?\DateTimeInterface
    {
        return $this->dateRdv;
    }

    public function setDateRdv(\DateTimeInterface $dateRdv): self
    {
        $this->dateRdv = $dateRdv;

        return $this;
    }

    public function getEstUrgent(): ?int
    {
        return $this->estUrgent;
    }

    public function setEstUrgent(int $estUrgent): self
    {
        $this->estUrgent = $estUrgent;

        return $this;
    }

    public function getCommentaireVeto(): ?string
    {
        return $this->commentaireVeto;
    }

    public function setCommentaireVeto(string $commentaireVeto): self
    {
        $this->commentaireVeto = $commentaireVeto;

        return $this;
    }

    public function getEstDomicile(): ?int
    {
        return $this->estDomicile;
    }

    public function setEstDomicile(int $estDomicile): self
    {
        $this->estDomicile = $estDomicile;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getVeterinaire(): ?Veterinaire
    {
        return $this->veterinaire;
    }

    public function setVeterinaire(?Veterinaire $veterinaire): self
    {
        $this->veterinaire = $veterinaire;

        return $this;
    }

    public function getHoraire(): ?int
    {
        return $this->horaire;
    }

    public function setHoraire(int $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }
}
