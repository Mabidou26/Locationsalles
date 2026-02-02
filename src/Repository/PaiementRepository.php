<?php

namespace App\Repository;

use App\Entity\Paiement;
use App\Entity\Factures;
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
    public function findByMethode(MethodePaiement|string $methode): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.Methode_paiement = :methode')
            ->setParameter('methode', $methode)
            ->getQuery()
            ->getResult();
    }

    public function findOneByFactures(Factures $factures): ?Paiement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.Factures = :factures')
            ->setParameter('factures', $factures)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
