<?php

namespace App\Entity;

use App\Repository\PrimeObtenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrimeObtenuRepository::class)]
class PrimeObtenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $somme = null;

    #[ORM\ManyToOne(inversedBy: 'primeObtenus')]
    private ?Salaire $salaireprimeobtenu = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSomme(): ?string
    {
        return $this->somme;
    }

    public function setSomme(?string $somme): static
    {
        $this->somme = $somme;

        return $this;
    }

    public function getSalaireprimeobtenu(): ?Salaire
    {
        return $this->salaireprimeobtenu;
    }

    public function setSalaireprimeobtenu(?Salaire $salaireprimeobtenu): static
    {
        $this->salaireprimeobtenu = $salaireprimeobtenu;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

}
