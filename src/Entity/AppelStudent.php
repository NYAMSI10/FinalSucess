<?php

namespace App\Entity;

use App\Repository\AppelStudentRepository;
use App\Trait\TimeStampTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppelStudentRepository::class)]
class AppelStudent
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $hourstart = null;

    #[ORM\Column(length: 255)]
    private ?string $hoursend = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

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

    public function getHourstart(): ?string
    {
        return $this->hourstart;
    }

    public function setHourstart(string $hourstart): static
    {
        $this->hourstart = $hourstart;

        return $this;
    }

    public function getHoursend(): ?string
    {
        return $this->hoursend;
    }

    public function setHoursend(string $hoursend): static
    {
        $this->hoursend = $hoursend;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): static
    {
        $this->jour = $jour;

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
