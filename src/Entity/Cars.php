<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarsRepository::class)]
class Cars
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $kilometrage = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nb_proprio = null;

    #[ORM\Column]
    private ?int $cylindree = null;

    #[ORM\Column]
    private ?int $puissance_ch = null;

    #[ORM\Column]
    private ?int $puissance_kw = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $year = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Modele $id_modele = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Carburant $id_carbu = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Transmission $id_transmi = null;

    #[ORM\ManyToMany(targetEntity: Images::class, mappedBy: 'id_cars')]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?TypeDeBoite $idTypeDeBoite = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Marque $idMarque = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getNbProprio(): ?int
    {
        return $this->nb_proprio;
    }

    public function setNbProprio(int $nb_proprio): self
    {
        $this->nb_proprio = $nb_proprio;

        return $this;
    }

    public function getCylindree(): ?int
    {
        return $this->cylindree;
    }

    public function setCylindree(int $cylindree): self
    {
        $this->cylindree = $cylindree;

        return $this;
    }

    public function getPuissanceCh(): ?int
    {
        return $this->puissance_ch;
    }

    public function setPuissanceCh(int $puissance_ch): self
    {
        $this->puissance_ch = $puissance_ch;

        return $this;
    }

    public function getPuissanceKw(): ?int
    {
        return $this->puissance_kw;
    }

    public function setPuissanceKw(int $puissance_kw): self
    {
        $this->puissance_kw = $puissance_kw;

        return $this;
    }

    public function getYear(): ?\DateTimeImmutable
    {
        return $this->year;
    }

    public function setYear(\DateTimeImmutable $year): self
    {
        $this->year = $year;

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

    public function getIdModele(): ?Modele
    {
        return $this->id_modele;
    }

    public function setIdModele(?Modele $id_modele): self
    {
        $this->id_modele = $id_modele;

        return $this;
    }

    public function getIdCarbu(): ?Carburant
    {
        return $this->id_carbu;
    }

    public function setIdCarbu(?Carburant $id_carbu): self
    {
        $this->id_carbu = $id_carbu;

        return $this;
    }

    public function getIdTransmi(): ?Transmission
    {
        return $this->id_transmi;
    }

    public function setIdTransmi(?Transmission $id_transmi): self
    {
        $this->id_transmi = $id_transmi;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->addIdCar($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            $image->removeIdCar($this);
        }

        return $this;
    }

    public function getIdTypeDeBoite(): ?TypeDeBoite
    {
        return $this->idTypeDeBoite;
    }

    public function setIdTypeDeBoite(?TypeDeBoite $idTypeDeBoite): self
    {
        $this->idTypeDeBoite = $idTypeDeBoite;

        return $this;
    }

    public function getIdMarque(): ?Marque
    {
        return $this->idMarque;
    }

    public function setIdMarque(?Marque $idMarque): self
    {
        $this->idMarque = $idMarque;

        return $this;
    }
}
