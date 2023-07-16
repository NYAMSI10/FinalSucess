<?php

namespace App\Entity;

use App\Repository\SalaireRepository;
use App\Trait\TimeStampTrait;
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

    public function __construct()
    {
        $this->createAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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
}
