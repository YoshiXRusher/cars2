<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\ManyToMany(targetEntity: Cars::class, inversedBy: 'images')]
    private Collection $id_cars;

    public function __construct()
    {
        $this->id_cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection<int, Cars>
     */
    public function getIdCars(): Collection
    {
        return $this->id_cars;
    }

    public function addIdCar(Cars $idCar): self
    {
        if (!$this->id_cars->contains($idCar)) {
            $this->id_cars->add($idCar);
        }

        return $this;
    }

    public function removeIdCar(Cars $idCar): self
    {
        $this->id_cars->removeElement($idCar);

        return $this;
    }
}
