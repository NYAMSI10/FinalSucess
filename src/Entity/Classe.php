<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use App\Trait\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Classe
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $frais = null;
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'userclasse')]
    private Collection $users;
    #[ORM\OneToMany(mappedBy: 'classepresence', targetEntity: PresenceStudent::class)]
    private Collection $presenceStudents;



    public function __construct()
    {
        $this->createAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->users = new ArrayCollection();
        $this->presenceStudents = new ArrayCollection();

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

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addUserclasse($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeUserclasse($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PresenceStudent>
     */
    public function getPresenceStudents(): Collection
    {
        return $this->presenceStudents;
    }

    public function addPresenceStudent(PresenceStudent $presenceStudent): static
    {
        if (!$this->presenceStudents->contains($presenceStudent)) {
            $this->presenceStudents->add($presenceStudent);
            $presenceStudent->setMatierepresence($this);
        }

        return $this;
    }

    public function removePresenceStudent(PresenceStudent $presenceStudent): static
    {
        if ($this->presenceStudents->removeElement($presenceStudent)) {
            // set the owning side to null (unless already changed)
            if ($presenceStudent->getMatierepresence() === $this) {
                $presenceStudent->setMatierepresence(null);
            }
        }

        return $this;
    }

}
