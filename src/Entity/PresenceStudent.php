<?php

namespace App\Entity;

use App\Repository\PresenceStudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresenceStudentRepository::class)]
#[ORM\HasLifecycleCallbacks]

class PresenceStudent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $hourstart = null;

    #[ORM\Column(length: 255)]
    private ?string $hoursend = null;

    #[ORM\ManyToOne(inversedBy: 'presenceStudents')]
    private ?User $userpresence = null;

    #[ORM\ManyToOne(inversedBy: 'presenceStudents')]
    private ?Matiere $matierepresence = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'absenceStudents')]
    private Collection $student;

    #[ORM\Column(nullable: true)]
    private ?bool  $IsAccept= null;

    #[ORM\ManyToOne(inversedBy: 'presenceStudents')]
    private ?Periode $periodepresence = null;

    #[ORM\ManyToOne(inversedBy: 'presenceStudents')]
    private ?Classe $classepresence = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $datejours = null;




    public function __construct()
    {
        $this->student = new ArrayCollection();
        $this->createdAt = new \DateTime();
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

    public function getUserpresence(): ?User
    {
        return $this->userpresence;
    }

    public function setUserpresence(?User $userpresence): static
    {
        $this->userpresence = $userpresence;

        return $this;
    }

    public function getMatierepresence(): ?Matiere
    {
        return $this->matierepresence;
    }

    public function setMatierepresence(?Matiere $matierepresence): static
    {
        $this->matierepresence = $matierepresence;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

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

    /**
     * @return Collection<int, User>
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(User $student): static
    {
        if (!$this->student->contains($student)) {
            $this->student[] =$student;

        }

        return $this;
    }

    public function removeStudent(User $student): static
    {
        $this->student->removeElement($student);

        return $this;
    }
    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function isIsAccept(): ?bool
    {
        return $this->IsAccept;
    }

    public function setIsAccept(?bool $IsAccept): static
    {
        $this->IsAccept = $IsAccept;

        return $this;
    }

    public function getPeriodepresence(): ?Periode
    {
        return $this->periodepresence;
    }

    public function setPeriodepresence(?Periode $periodepresence): static
    {
        $this->periodepresence = $periodepresence;

        return $this;
    }

    public function getClassepresence(): ?Classe
    {
        return $this->classepresence;
    }

    public function setClassepresence(?Classe $classepresence): static
    {
        $this->classepresence = $classepresence;

        return $this;
    }

    public function getDatejours(): ?string
    {
        return $this->datejours;
    }

    public function setDatejours(?string $datejours): static
    {
        $this->datejours = $datejours;

        return $this;
    }



}
