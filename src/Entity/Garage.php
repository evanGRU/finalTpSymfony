<?php

namespace App\Entity;

use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarageRepository::class)]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomGarage = null;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Voiture::class)]
    private Collection $voiture;

    #[ORM\OneToOne(mappedBy: 'garage', cascade: ['persist', 'remove'])]
    private ?Lieu $lieu = null;

    public function __construct()
    {
        $this->voiture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGarage(): ?string
    {
        return $this->nomGarage;
    }

    public function setNomGarage(string $nomGarage): self
    {
        $this->nomGarage = $nomGarage;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoiture(): Collection
    {
        return $this->voiture;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voiture->contains($voiture)) {
            $this->voiture->add($voiture);
            $voiture->setGarage($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voiture->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getGarage() === $this) {
                $voiture->setGarage(null);
            }
        }

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        // unset the owning side of the relation if necessary
        if ($lieu === null && $this->lieu !== null) {
            $this->lieu->setGarage(null);
        }

        // set the owning side of the relation if necessary
        if ($lieu !== null && $lieu->getGarage() !== $this) {
            $lieu->setGarage($this);
        }

        $this->lieu = $lieu;

        return $this;
    }
}
