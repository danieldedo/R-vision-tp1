<?php

namespace App\Entity;

use App\Repository\SejourRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SejourRepository::class)]
class Sejour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sejours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voyageur $voyageur = null;

    #[ORM\ManyToOne(inversedBy: 'sejours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Logement $logement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoyageur(): ?Voyageur
    {
        return $this->voyageur;
    }

    public function setVoyageur(?Voyageur $voyageur): static
    {
        $this->voyageur = $voyageur;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(?\DateTimeInterface $debut): static
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(?\DateTimeInterface $fin): static
    {
        $this->fin = $fin;

        return $this;
    }

    public function getLogement(): ?Logement
    {
        return $this->logement;
    }

    public function setLogement(?Logement $logement): static
    {
        $this->logement = $logement;

        return $this;
    }

  
}
