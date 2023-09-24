<?php

namespace App\Entity;

use App\Repository\EvenementObtenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementObtenuRepository::class)]
class EvenementObtenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $somme = null;

    #[ORM\ManyToOne(inversedBy: 'evenementObtenus')]
    private ?Salaire $salaireevenobtenu = null;



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

    public function getSalaireevenobtenu(): ?Salaire
    {
        return $this->salaireevenobtenu;
    }

    public function setSalaireevenobtenu(?Salaire $salaireevenobtenu): static
    {
        $this->salaireevenobtenu = $salaireevenobtenu;

        return $this;
    }


}
