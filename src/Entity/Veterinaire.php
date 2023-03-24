<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VeterianireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VeterianireRepository::class)]
#[ApiResource]
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