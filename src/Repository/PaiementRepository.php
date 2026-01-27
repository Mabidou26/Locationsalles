<?php

namespace App\Repository;

use App\Entity\Paiement;
use App\Entity\Facture;
use App\Enum\MethodePaiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Paiement>
 */
class PaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paiement::class);
    }

    /**
     * @return Paiement[]
     */
    public function findByMethode(MethodePaiement $methode): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.methode = :methode')
            ->setParameter('methode', $methode)
            ->orderBy('p.datePaiement', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findOneByFacture(Facture $facture): ?Paiement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.facture = :facture')
            ->setParameter('facture', $facture)
            ->getQuery()
            ->getOneOrNullResult();
            
    }
}
