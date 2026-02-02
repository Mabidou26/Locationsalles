<?php

namespace App\DataFixtures;

use App\Entity\Factures;
use App\Entity\Reservations;
use App\Enum\StatutFactures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FacturesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer une réservation (obligatoire car Factures a une relation non-nullable)
        $reservation = new Reservations();
        // Ajoutez les champs nécessaires pour Reservations
        // $reservation->setDateDebut(new \DateTimeImmutable());
        // $reservation->setDateFin(new \DateTimeImmutable('+3 days'));
        $manager->persist($reservation);

        // Créer 5 factures
        for ($i = 1; $i <= 5; $i++) {
            $facture = new Factures();
            $facture->setMontantTotal((string)(300 * $i)); // 300.00, 600.00, 900.00, etc.
            
            // Alterner les statuts
            if ($i % 3 === 0) {
                $facture->setStatut(StatutFactures::Payee);
            } elseif ($i % 3 === 1) {
                $facture->setStatut(StatutFactures::En_attente);
            } else {
                $facture->setStatut(StatutFactures::Annulee);
            }
            
            $facture->setReservations($reservation);
            // createdAt et updatedAt sont définis dans le constructeur
            
            $manager->persist($facture);
            
            // Sauvegarder la référence pour l'utiliser dans PaiementFixtures
            $this->addReference('facture_' . $i, $facture);
        }

        $manager->flush();
    }
}