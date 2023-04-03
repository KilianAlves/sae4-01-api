<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\VeterianireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VeterianireRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(
            normalizationContext: ['groups' => ['get_Me', 'get_User']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_VETERINAIRE')",
        ),
        new Patch(
            normalizationContext: ['groups' => ['get_Me', 'get_User']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user",
        ),
    ],
    normalizationContext: ['groups' => ['get_User']]
)]
class Veterinaire extends Utilisateur
{
    #[ORM\OneToMany(mappedBy: 'veterinaire', targetEntity: rendez_vous::class)]
    private Collection $rendezVous;

    public function __construct()
    {
        $this->rendezVous = new ArrayCollection();
    }

    /*
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    */

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
            $rendezVou->setVeterinaire($this);
        }

        return $this;
    }

    public function removeRendezVou(rendez_vous $rendezVou): self
    {
        if ($this->rendezVous->removeElement($rendezVou)) {
            // set the owning side to null (unless already changed)
            if ($rendezVou->getVeterinaire() === $this) {
                $rendezVou->setVeterinaire(null);
            }
        }

        return $this;
    }
}
