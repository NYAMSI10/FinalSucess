<?php

namespace App\Entity;

use App\Repository\ScolariteRepository;
use App\Trait\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScolariteRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Scolarite
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $avance = null;

    #[ORM\Column]
    private ?int $reste = null;

    #[ORM\Column(length: 255)]
    private ?string $mois = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'histscolarite', targetEntity: Historique::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $historiques;

    #[ORM\ManyToOne(inversedBy: 'scolarites')]
    private ?User $userscolarite = null;

    #[ORM\Column(length: 255)]
    private ?string $ref = null;



    public function __construct()
    {
        $this->createAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->historiques = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAvance(): ?int
    {
        return $this->avance;
    }

    public function setAvance(int $avance): static
    {
        $this->avance = $avance;

        return $this;
    }

    public function getReste(): ?int
    {
        return $this->reste;
    }

    public function setReste(int $reste): static
    {
        $this->reste = $reste;

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
    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): static
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * @return Collection<int, Historique>
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Historique $historique): static
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques->add($historique);
            $historique->setHistscolarite($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): static
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getHistscolarite() === $this) {
                $historique->setHistscolarite(null);
            }
        }

        return $this;
    }

    public function getUserscolarite(): ?User
    {
        return $this->userscolarite;
    }

    public function setUserscolarite(?User $userscolarite): static
    {
        $this->userscolarite = $userscolarite;

        return $this;
    }

    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function __toString(): string
    {
        return  $this->getMois();
    }
}
