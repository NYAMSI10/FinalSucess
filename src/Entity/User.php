<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true,nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $quartier = null;

    #[ORM\Column]
    private ?int $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $inscription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column]
    private ?int $matricule = null;

    #[ORM\Column]
    private ?bool $IsTeacher = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $school = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IsRame = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $annee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;


    #[ORM\Column(nullable: true)]
    private ?int $salairesceance = null;

    #[ORM\ManyToMany(targetEntity: Periode::class, inversedBy: 'users' )]
    private Collection $userperiode;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'users' )]
    private Collection $userclasse;

    #[ORM\ManyToMany(targetEntity: Matiere::class, inversedBy: 'users' )]
    private Collection $usermatiere;

    #[ORM\OneToMany(mappedBy: 'userscolarite', targetEntity: Scolarite::class)]
    private Collection $scolarites;

    #[ORM\Column(nullable: true)]
    private ?bool $IsAtive = null;

    #[ORM\OneToMany(mappedBy: 'usercotisation', targetEntity: Cotisation::class, cascade: ['persist','remove'])]
    private Collection $cotisations;

    #[ORM\OneToMany(mappedBy: 'userpresence', targetEntity: PresenceStudent::class,  cascade: ['remove'])]
    private Collection $presenceStudents;

    #[ORM\ManyToMany(targetEntity: PresenceStudent::class, mappedBy: 'student', cascade: ['remove'])]
    private Collection $absenceStudents;

    #[ORM\OneToMany(mappedBy: 'usersalaire', targetEntity: Salaire::class, cascade: ['persist','remove'])]
    private Collection $salaires;

    public function __construct()
    {
        $this->createAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->userperiode = new ArrayCollection();
        $this->userclasse = new ArrayCollection();
        $this->usermatiere = new ArrayCollection();
        $this->scolarites = new ArrayCollection();
        $this->cotisations = new ArrayCollection();
        $this->presenceStudents = new ArrayCollection();
        $this->absenceStudents = new ArrayCollection();
        $this->salaires = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(string $quartier): static
    {
        $this->quartier = $quartier;

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
    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getInscription(): ?string
    {
        return $this->inscription;
    }

    public function setInscription(?string $inscription): static
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function isIsTeacher(): ?bool
    {
        return $this->IsTeacher;
    }

    public function setIsTeacher(bool $IsTeacher): static
    {
        $this->IsTeacher = $IsTeacher;

        return $this;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(?string $school): static
    {
        $this->school = $school;

        return $this;
    }

    public function isIsRame(): ?bool
    {
        return $this->IsRame;
    }

    public function setIsRame(?bool $IsRame): static
    {
        $this->IsRame = $IsRame;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(?string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }
    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }



    public function getSalairesceance(): ?int
    {
        return $this->salairesceance;
    }

    public function setSalairesceance(?int $salairesceance): static
    {
        $this->salairesceance = $salairesceance;

        return $this;
    }


    /**
     * @return Collection<int, Periode>
     */
    public function getUserperiode(): Collection
    {
        return $this->userperiode;
    }

    public function addUserperiode(Periode $userperiode): static
    {
        if (!$this->userperiode->contains($userperiode)) {
            $this->userperiode[] = $userperiode;


        }

        return $this;
    }

    public function removeUserperiode(Periode $userperiode): static
    {
        $this->userperiode->removeElement($userperiode);

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getUserclasse(): Collection
    {
        return $this->userclasse;
    }

    public function addUserclasse(Classe $userclasse): static
    {
        if (!$this->userclasse->contains($userclasse)) {
            $this->userclasse[] =$userclasse;

        }

        return $this;
    }

    public function removeUserclasse(Classe $userclasse): static
    {
        $this->userclasse->removeElement($userclasse);

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getUsermatiere(): Collection
    {
        return $this->usermatiere;
    }

    public function addUsermatiere(Matiere $usermatiere): static
    {
        if (!$this->usermatiere->contains($usermatiere)) {
            $this->usermatiere[] = $usermatiere;
        }

        return $this;
    }

    public function removeUsermatiere(Matiere $usermatiere): static
    {
        $this->usermatiere->removeElement($usermatiere);

        return $this;
    }

    /**
     * @return Collection<int, Scolarite>
     */
    public function getScolarites(): Collection
    {
        return $this->scolarites;
    }

    public function addScolarite(Scolarite $scolarite): static
    {
        if (!$this->scolarites->contains($scolarite)) {
            $this->scolarites->add($scolarite);
            $scolarite->setUserscolarite($this);
        }

        return $this;
    }

    public function removeScolarite(Scolarite $scolarite): static
    {
        if ($this->scolarites->removeElement($scolarite)) {
            // set the owning side to null (unless already changed)
            if ($scolarite->getUserscolarite() === $this) {
                $scolarite->setUserscolarite(null);
            }
        }

        return $this;
    }

    public function isIsAtive(): ?bool
    {
        return $this->IsAtive;
    }

    public function setIsAtive(?bool $IsAtive): static
    {
        $this->IsAtive = $IsAtive;

        return $this;
    }

    /**
     * @return Collection<int, Cotisation>
     */
    public function getCotisations(): Collection
    {
        return $this->cotisations;
    }

    public function addCotisation(Cotisation $cotisation): static
    {
        if (!$this->cotisations->contains($cotisation)) {
            $this->cotisations->add($cotisation);
            $cotisation->setUsercotisation($this);
        }

        return $this;
    }

    public function removeCotisation(Cotisation $cotisation): static
    {
        if ($this->cotisations->removeElement($cotisation)) {
            // set the owning side to null (unless already changed)
            if ($cotisation->getUsercotisation() === $this) {
                $cotisation->setUsercotisation(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFirstname();
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
            $presenceStudent->setUserpresence($this);
        }

        return $this;
    }

    public function removePresenceStudent(PresenceStudent $presenceStudent): static
    {
        if ($this->presenceStudents->removeElement($presenceStudent)) {
            // set the owning side to null (unless already changed)
            if ($presenceStudent->getUserpresence() === $this) {
                $presenceStudent->setUserpresence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PresenceStudent>
     */
    public function getAbsenceStudents(): Collection
    {
        return $this->absenceStudents;
    }

    public function addAbsenceStudent(PresenceStudent $absenceStudent): static
    {
        if (!$this->absenceStudents->contains($absenceStudent)) {
            $this->absenceStudents->add($absenceStudent);
            $absenceStudent->addStudent($this);
        }

        return $this;
    }

    public function removeAbsenceStudent(PresenceStudent $absenceStudent): static
    {
        if ($this->absenceStudents->removeElement($absenceStudent)) {
            $absenceStudent->removeStudent($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Salaire>
     */
    public function getSalaires(): Collection
    {
        return $this->salaires;
    }

    public function addSalaire(Salaire $salaire): static
    {
        if (!$this->salaires->contains($salaire)) {
            $this->salaires->add($salaire);
            $salaire->setUsersalaire($this);
        }

        return $this;
    }

    public function removeSalaire(Salaire $salaire): static
    {
        if ($this->salaires->removeElement($salaire)) {
            // set the owning side to null (unless already changed)
            if ($salaire->getUsersalaire() === $this) {
                $salaire->setUsersalaire(null);
            }
        }

        return $this;
    }


}
