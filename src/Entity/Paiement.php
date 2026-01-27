<?php

namespace App\Entity;

use App\Enum\MethodePaiement;
use App\Repository\PaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(nullable: false)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Facture::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Facture $facture;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: false)]
    private string $montant;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: false)]
    private \DateTimeInterface $datePaiement;

    #[ORM\Column(enumType: MethodePaiement::class, nullable: false)]
    private MethodePaiement $methode;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFacture(): Facture
    {
        return $this->facture;
    }

    public function setFacture(Facture $facture): self
    {
        $this->facture = $facture;
        return $this;
    }

    public function getMontant(): string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;
        return $this;
    }

    public function getDatePaiement(): \DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $datePaiement): self
    {
        $this->datePaiement = $datePaiement;
        return $this;
    }

    public function getMethode(): MethodePaiement
    {
        return $this->methode;
    }

    public function setMethode(MethodePaiement $methode): self
    {
        $this->methode = $methode;
        return $this;
    }
}
