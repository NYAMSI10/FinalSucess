<?php

namespace App\Entity;

use App\Repository\SalaireRepository;
use App\Trait\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaireRepository::class)]
class Salaire
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mois = null;

    #[ORM\Column(length: 255)]
    private ?string $montantfrais = null;

    #[ORM\Column]
    private ?int $nbretravail = null;

    #[ORM\Column]
    private ?int $montantsalaire = null;

    #[ORM\Column]
    private ?int $amical = null;

    #[ORM\Column]
    private ?int $benefcotisation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;



    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cotisation = null;

    #[ORM\ManyToOne(inversedBy: 'salaires')]
    private ?Periode $periodesalaire = null;

    #[ORM\ManyToOne(inversedBy: 'salaires')]
    private ?User $usersalaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ref = null;

    #[ORM\OneToMany(mappedBy: 'salaireprimeobtenu', targetEntity: PrimeObtenu::class,orphanRemoval: true)]
    private Collection $primeObtenus;

    #[ORM\OneToMany(mappedBy: 'salaireevenobtenu', targetEntity: EvenementObtenu::class,orphanRemoval: true)]
    private Collection $evenementObtenus;

    public function __construct()
    {
        $this->createAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->primeObtenus = new ArrayCollection();
        $this->evenementObtenus = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): static
    {
        $this->mois = $mois;

        return $this;
    }

    public function getMontantfrais(): ?string
    {
        return $this->montantfrais;
    }

    public function setMontantfrais(string $montantfrais): static
    {
        $this->montantfrais = $montantfrais;

        return $this;
    }

    public function getNbretravail(): ?int
    {
        return $this->nbretravail;
    }

    public function setNbretravail(int $nbretravail): static
    {
        $this->nbretravail = $nbretravail;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    public function getMontantsalaire(): ?int
    {
        return $this->montantsalaire;
    }

    public function setMontantsalaire(int $montantsalaire): static
    {
        $this->montantsalaire = $montantsalaire;

        return $this;
    }

    public function getAmical(): ?int
    {
        return $this->amical;
    }

    public function setAmical(int $amical): static
    {
        $this->amical = $amical;

        return $this;
    }

    public function getBenefcotisation(): ?int
    {
        return $this->benefcotisation;
    }

    public function setBenefcotisation(int $benefcotisation): static
    {
        $this->benefcotisation = $benefcotisation;

        return $this;
    }




    public function getCotisation(): ?string
    {
        return $this->cotisation;
    }

    public function setCotisation(?string $cotisation): static
    {
        $this->cotisation = $cotisation;

        return $this;
    }

    public function getPeriodesalaire(): ?Periode
    {
        return $this->periodesalaire;
    }

    public function setPeriodesalaire(?Periode $periodesalaire): static
    {
        $this->periodesalaire = $periodesalaire;

        return $this;
    }

    public function getUsersalaire(): ?User
    {
        return $this->usersalaire;
    }

    public function setUsersalaire(?User $usersalaire): static
    {
        $this->usersalaire = $usersalaire;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * @return Collection<int, PrimeObtenu>
     */
    public function getPrimeObtenus(): Collection
    {
        return $this->primeObtenus;
    }

    public function addPrimeObtenu(PrimeObtenu $primeObtenu): static
    {
        if (!$this->primeObtenus->contains($primeObtenu)) {
            $this->primeObtenus->add($primeObtenu);
            $primeObtenu->setSalaireprimeobtenu($this);
        }

        return $this;
    }

    public function removePrimeObtenu(PrimeObtenu $primeObtenu): static
    {
        if ($this->primeObtenus->removeElement($primeObtenu)) {
            // set the owning side to null (unless already changed)
            if ($primeObtenu->getSalaireprimeobtenu() === $this) {
                $primeObtenu->setSalaireprimeobtenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EvenementObtenu>
     */
    public function getEvenementObtenus(): Collection
    {
        return $this->evenementObtenus;
    }

    public function addEvenementObtenu(EvenementObtenu $evenementObtenu): static
    {
        if (!$this->evenementObtenus->contains($evenementObtenu)) {
            $this->evenementObtenus->add($evenementObtenu);
            $evenementObtenu->setSalaireevenobtenu($this);
        }

        return $this;
    }

    public function removeEvenementObtenu(EvenementObtenu $evenementObtenu): static
    {
        if ($this->evenementObtenus->removeElement($evenementObtenu)) {
            // set the owning side to null (unless already changed)
            if ($evenementObtenu->getSalaireevenobtenu() === $this) {
                $evenementObtenu->setSalaireevenobtenu(null);
            }
        }

        return $this;
    }
}
