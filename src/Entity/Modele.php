<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'id_model')]
    private ?Marque $marque = null;

    #[ORM\OneToMany(mappedBy: 'id_modele', targetEntity: Cars::class)]
    private Collection $cars;

    #[ORM\Column]
    private ?int $yearModele = null;

    public function __toString() {
        return $this->name;
    }

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, Cars>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Cars $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setIdModele($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getIdModele() === $this) {
                $car->setIdModele(null);
            }
        }

        return $this;
    }

    public function getYearModele(): ?int
    {
        return $this->yearModele;
    }

    public function setYearModele(int $yearModele): self
    {
        $this->yearModele = $yearModele;

        return $this;
    }
}
