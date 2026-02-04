<?php

namespace App\DataFixtures;

use App\Entity\Salles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SallesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sallesData = [
            [
                'nom' => 'Horizon',
                'capacite' => 50,
                'prix' => '350.00',
                'description' => 'Salle moderne avec vue panoramique, équipée d\'un vidéoprojecteur 4K et d\'un système audio professionnel. Idéale pour les conférences et séminaires.',
                'reference' => 'SALLE_HORIZON'
            ],
            [
                'nom' => 'Conférence Pro',
                'capacite' => 100,
                'prix' => '550.00',
                'description' => 'Grande salle de conférence professionnelle avec scène, système de sonorisation haut de gamme et éclairage modulable. Parfaite pour les grandes présentations.',
                'reference' => 'SALLE_CONFERENCE_PRO'
            ],
            [
                'nom' => 'Créative',
                'capacite' => 30,
                'prix' => '250.00',
                'description' => 'Espace chaleureux et modulable pour ateliers créatifs, brainstorming et formations. Équipée de tableaux blancs interactifs et mobilier flexible.',
                'reference' => 'SALLE_CREATIVE'
            ],
            [
                'nom' => 'Executive',
                'capacite' => 20,
                'prix' => '450.00',
                'description' => 'Salle de réunion haut de gamme pour les comités de direction. Table ovale en bois massif, écrans interactifs et confidentialité assurée.',
                'reference' => 'SALLE_EXECUTIVE'
            ],
            [
                'nom' => 'Startup Lab',
                'capacite' => 15,
                'prix' => '180.00',
                'description' => 'Espace coworking moderne avec ambiance startup. Wifi ultra-rapide, prises multiples, canapés confortables et tableau de présentation mobile.',
                'reference' => 'SALLE_STARTUP_LAB'
            ]
        ];

        foreach ($sallesData as $data) {
            $salle = new Salles();
            $salle->setNom($data['nom']);
            $salle->setCapacite($data['capacite']);
            $salle->setPrixJournalier($data['prix']);
            $salle->setDescription($data['description']);
            
            $manager->persist($salle);
            $this->addReference($data['reference'], $salle);
        }

        $manager->flush();
    }
}
