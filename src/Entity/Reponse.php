<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\ReponseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(
            normalizationContext: ['groups' => ['get_Reponse']]
        ),
        new Post(
            normalizationContext: ['groups' => ['get_Reponse']],
            denormalizationContext: ['groups' => ['set_Reponse']],
            security: "is_granted('IS_AUTHENTICATED_FULLY')"
        ),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['question' => 'exact'])]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Reponse'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_Reponse', 'set_Reponse'])]
    private ?string $texte = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['get_Reponse', 'set_Reponse'])]
    private ?\DateTimeInterface $ecriteDate = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Reponse', 'set_Reponse'])]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Reponse', 'set_Reponse'])]
    private ?Question $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getEcriteDate(): ?\DateTimeInterface
    {
        return $this->ecriteDate;
    }

    public function setEcriteDate(\DateTimeInterface $ecriteDate): self
    {
        $this->ecriteDate = $ecriteDate;

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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
