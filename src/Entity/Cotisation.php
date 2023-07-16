<?php

namespace App\Entity;

use App\Repository\CotisationRepository;
use App\Trait\TimeStampTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CotisationRepository::class)]
class Cotisation
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $somme = null;

    #[ORM\Column(length: 255)]
    private ?string $moisbouffe = null;

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

    public function getSomme(): ?string
    {
        return $this->somme;
    }

    public function setSomme(string $somme): static
    {
        $this->somme = $somme;

        return $this;
    }

    public function getMoisbouffe(): ?string
    {
        return $this->moisbouffe;
    }

    public function setMoisbouffe(string $moisbouffe): static
    {
        $this->moisbouffe = $moisbouffe;

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
}
