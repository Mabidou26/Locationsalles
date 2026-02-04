<?php

namespace App\DataFixtures;

use App\Entity\Paiement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Delete;


#[ApiResource(
    operations: [
        new GetCollection(security: "is_granted('ROLE_ADMIN')"),
        new Get(security: "is_granted('ROLE_ADMIN') or object == user"),
        new Post(security: "is_granted('ROLE_ADMIN')"),
        new Put(security: "is_granted('ROLE_ADMIN') or object == user"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ]
)]
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