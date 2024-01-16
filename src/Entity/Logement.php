<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LogementRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: LogementRepository::class)]
#[UniqueEntity('code')]
class Logement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\OneToMany(mappedBy: 'logement', targetEntity: Sejour::class, orphanRemoval: true)]
    private Collection $sejours;

    #[ORM\Column]
    private ?bool $disponibilite = null;

    public function __construct()
    {
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function isDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * @return Collection<int, Sejour>
     */
    public function getSejours(): Collection
    {
        return $this->sejours;
    }

    public function addSejour(Sejour $sejour): static
    {
        if (!$this->sejours->contains($sejour)) {
            $this->sejours->add($sejour);
            $sejour->setLogement($this);
        }

        return $this;
    }

    public function removeSejour(Sejour $sejour): static
    {
        if ($this->sejours->removeElement($sejour)) {
            // set the owning side to null (unless already changed)
            if ($sejour->getLogement() === $this) {
                $sejour->setLogement(null);
            }
        }

        return $this;
    }
}
