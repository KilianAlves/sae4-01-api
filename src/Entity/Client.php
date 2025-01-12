<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(
            normalizationContext: ['groups' => ['get_Me', 'get_User']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER')",
        ),
        new Patch(
            normalizationContext: ['groups' => ['get_Me', 'get_User']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user",
        ),
        new Put(
            normalizationContext: ['groups' => ['get_Me', 'get_User']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user",
        ),
    ],
    normalizationContext: ['groups' => ['get_User']]
)]
class Client extends Utilisateur
{
    /*
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    */

    #[ORM\Column(nullable: true)]
    #[Groups(['get_User', 'set_User'])]
    private ?float $solde = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $commentaire = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: rendez_vous::class)]
    private Collection $rendezVous;

    public function __construct()
    {
        $this->rendezVous = new ArrayCollection();
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(?float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection<int, rendez_vous>
     */
    public function getRendezVous(): Collection
    {
        return $this->rendezVous;
    }

    public function addRendezVou(rendez_vous $rendezVou): self
    {
        if (!$this->rendezVous->contains($rendezVou)) {
            $this->rendezVous->add($rendezVou);
            $rendezVou->setClient($this);
        }

        return $this;
    }

    public function removeRendezVou(rendez_vous $rendezVou): self
    {
        if ($this->rendezVous->removeElement($rendezVou)) {
            // set the owning side to null (unless already changed)
            if ($rendezVou->getClient() === $this) {
                $rendezVou->setClient(null);
            }
        }

        return $this;
    }
}
