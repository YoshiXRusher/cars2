<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Modele::class)]
    private Collection $id_model;

    #[ORM\OneToMany(mappedBy: 'idMarque', targetEntity: Cars::class)]
    private Collection $cars;

    public function __construct()
    {
        $this->id_model = new ArrayCollection();
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

    /**
     * @return Collection<int, Modele>
     */
    public function getIdModel(): Collection
    {
        return $this->id_model;
    }

    public function addIdModel(Modele $idModel): self
    {
        if (!$this->id_model->contains($idModel)) {
            $this->id_model->add($idModel);
            $idModel->setMarque($this);
        }

        return $this;
    }

    public function removeIdModel(Modele $idModel): self
    {
        if ($this->id_model->removeElement($idModel)) {
            // set the owning side to null (unless already changed)
            if ($idModel->getMarque() === $this) {
                $idModel->setMarque(null);
            }
        }

        return $this;
    }

}
