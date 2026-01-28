<?php

namespace App\Entity;

use App\Repository\FacturesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacturesRepository::class)]
class Factures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $montant_total = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $Statut = [];

    #[ORM\Column]
    private ?\DateTimeImmutable $Created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantTotal(): ?string
    {
        return $this->montant_total;
    }

    public function setMontantTotal(string $montant_total): static
    {
        $this->montant_total = $montant_total;

        return $this;
    }

    public function getStatut(): array
    {
        return $this->Statut;
    }

    public function setStatut(array $Statut): static
    {
        $this->Statut = $Statut;

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
        return $this->Updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $Updated_at): static
    {
        $this->Updated_at = $Updated_at;

        return $this;
    }
}
