<?php

namespace App\Entity;

use App\Repository\SallesRepository;
use BcMath\Number;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SallesRepository::class)]
class Salles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Nom_de_salle = null;

    #[ORM\Column(type: Types::NUMBER)]
    private ?Number $Capacité = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Descriptif = null;

    #[ORM\Column]
    private ?bool $Disponible = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDeSalle(): ?string
    {
        return $this->Nom_de_salle;
    }

    public function setNomDeSalle(string $Nom_de_salle): static
    {
        $this->Nom_de_salle = $Nom_de_salle;

        return $this;
    }

    public function getCapacité(): ?Number
    {
        return $this->Capacité;
    }

    public function setCapacité(Number $Capacité): static
    {
        $this->Capacité = $Capacité;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->Descriptif;
    }

    public function setDescriptif(string $Descriptif): static
    {
        $this->Descriptif = $Descriptif;

        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->Disponible;
    }

    public function setDisponible(bool $Disponible): static
    {
        $this->Disponible = $Disponible;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->Created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $Created_at): static
    {
        $this->Created_at = $Created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
