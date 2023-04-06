<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(
            normalizationContext: ['groups' => ['get_Question']]
        ),
        new Post(
            normalizationContext: ['groups' => ['get_Question']],
            denormalizationContext: ['groups' => ['set_Question']],
            security: "is_granted('IS_AUTHENTICATED_FULLY')"
        ),
    ],
    normalizationContext: ['groups' => ['get_Question', 'get_Reponse']]
)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Question'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_Question', 'set_Question'])]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_Question', 'set_Question'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['get_Question', 'set_Question'])]
    private ?\DateTimeInterface $dateEcriture = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Question', 'set_Question'])]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Reponse::class)]
    #[Groups(['get_Question'])]
    private $reponses;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateEcriture(): ?\DateTimeInterface
    {
        return $this->dateEcriture;
    }

    public function setDateEcriture(\DateTimeInterface $dateEcriture): self
    {
        $this->dateEcriture = $dateEcriture;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
