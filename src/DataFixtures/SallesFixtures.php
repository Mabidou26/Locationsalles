<?php

namespace App\DataFixtures;

use App\Entity\Salles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SallesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Salle 1 : Horizon
        $salle1 = new Salles();
        $salle1->setNom('Horizon');
        $salle1->setCapacite(50);
        $salle1->setPrixJournalier('350.00');
        $salle1->setDescription('Salle moderne avec vue panoramique, équipée d\'un vidéoprojecteur 4K et d\'un système audio professionnel. Idéale pour les conférences et séminaires.');
        
        $manager->persist($salle1);
        $this->addReference('SALLE_HORIZON', $salle1);

        // Salle 2 : Conférence Pro
        $salle2 = new Salles();
        $salle2->setNom('Conférence Pro');
        $salle2->setCapacite(100);
        $salle2->setPrixJournalier('550.00');
        $salle2->setDescription('Grande salle de conférence professionnelle avec scène, système de sonorisation haut de gamme et éclairage modulable. Parfaite pour les grandes présentations.');
        
        $manager->persist($salle2);
        $this->addReference('SALLE_CONFERENCE_PRO', $salle2);

        // Salle 3 : Créative
        $salle3 = new Salles();
        $salle3->setNom('Créative');
        $salle3->setCapacite(30);
        $salle3->setPrixJournalier('250.00');
        $salle3->setDescription('Espace chaleureux et modulable pour ateliers créatifs, brainstorming et formations. Équipée de tableaux blancs interactifs et mobilier flexible.');
        
        $manager->persist($salle3);
        $this->addReference('SALLE_CREATIVE', $salle3);

        // Salle 4 : Executive
        $salle4 = new Salles();
        $salle4->setNom('Executive');
        $salle4->setCapacite(20);
        $salle4->setPrixJournalier('450.00');
        $salle4->setDescription('Salle de réunion haut de gamme pour les comités de direction. Table ovale en bois massif, écrans interactifs et confidentialité assurée.');
        
        $manager->persist($salle4);
        $this->addReference('SALLE_EXECUTIVE', $salle4);

        // Salle 5 : Startup Lab
        $salle5 = new Salles();
        $salle5->setNom('Startup Lab');
        $salle5->setCapacite(15);
        $salle5->setPrixJournalier('180.00');
        $salle5->setDescription('Espace coworking moderne avec ambiance startup. Wifi ultra-rapide, prises multiples, canapés confortables et tableau de présentation mobile.');
        
        $manager->persist($salle5);
        $this->addReference('SALLE_STARTUP_LAB', $salle5);

        $manager->flush();
    }
}
