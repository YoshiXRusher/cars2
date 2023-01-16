<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    private ?int $nbproprio = null;

    #[ORM\Column]
    private ?int $cylindree = null;

    #[ORM\Column]
    private ?int $puissancech = null;

    #[ORM\Column]
    private ?int $puissancekw = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $year = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'La description ne peut pas etre vide')]
    #[Assert\Length(min:10,minMessage:'La description doit faire au moin 10 caracteres')]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Modele $modele = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Carburant $carbu = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Transmission $transmi = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?TypeDeBoite $typedeboite = null;

    #[ORM\Column(length: 255)]
    private ?string $cover = null;

    #[ORM\ManyToMany(targetEntity: Equipement::class, mappedBy: 'cars')]
    private Collection $equipements;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Images::class, cascade: ['persist'])]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->equipements = new ArrayCollection();
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
        return $this->nbproprio;
    }

    public function setNbProprio(int $nbproprio): self
    {
        $this->nbproprio = $nbproprio;

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
        return $this->puissancech;
    }

    public function setPuissanceCh(int $puissancech): self
    {
        $this->puissancech = $puissancech;

        return $this;
    }

    public function getPuissanceKw(): ?int
    {
        return $this->puissancekw;
    }

    public function setPuissanceKw(int $puissancekw): self
    {
        $this->puissancekw = $puissancekw;

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
        return $this->modele;
    }

    public function setIdModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getIdCarbu(): ?Carburant
    {
        return $this->carbu;
    }

    public function setIdCarbu(?Carburant $carbu): self
    {
        $this->carbu = $carbu;

        return $this;
    }

    public function getIdTransmi(): ?Transmission
    {
        return $this->transmi;
    }

    public function setIdTransmi(?Transmission $transmi): self
    {
        $this->transmi = $transmi;

        return $this;
    }


    public function getIdTypeDeBoite(): ?TypeDeBoite
    {
        return $this->typedeboite;
    }

    public function setIdTypeDeBoite(?TypeDeBoite $typedeboite): self
    {
        $this->typedeboite = $typedeboite;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): self
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->addCar($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): self
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeCar($this);
        }

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
            $image->setCar($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCar() === $this) {
                $image->setCar(null);
            }
        }

        return $this;
    }

}
