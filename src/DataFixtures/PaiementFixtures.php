<?php

namespace App\DataFixtures;

use App\Entity\Paiement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class PaiementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $methodesPaiement = ['Carte bancaire', 'Espèces', 'Virement', 'Chèque'];
        
        // Créer 2 paiements pour chaque facture
        for ($i = 1; $i <= 5; $i++) {
            $facture = $this->getReference('facture_' . $i);
            
            for ($j = 1; $j <= 2; $j++) {
                $paiement = new Paiement();
                $paiement->setMontant((string)(150 * $i)); // Moitié du montant de la facture
                $paiement->setDatePaiement(new \DateTime());
                $paiement->setMethodePaiement($methodesPaiement[array_rand($methodesPaiement)]);
                $paiement->setFactures($facture);
                $paiement->setCreatedAt(new \DateTimeImmutable());
                $paiement->setUpdatedAt(new \DateTimeImmutable());
                
                $manager->persist($paiement);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            FacturesFixtures::class,
        ];
    }
}
