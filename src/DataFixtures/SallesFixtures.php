<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Salles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer les 3 salles disponibles
        $salle1 = new Salles();
        $salle1->setNom('Horizon');
        $salle1->setCapacite(50); // exemple
        $manager->persist($salle1);

        $salle2 = new Salles();
        $salle2->setNom('Conférence Pro');
        $salle2->setCapacite(100);
        $manager->persist($salle2);

        $salle3 = new Salles();
        $salle3->setNom('Créative');
        $salle3->setCapacite(30);
        $manager->persist($salle3);

        // Créer un utilisateur qui commande une salle
        $user = new User();
        $user->setName('Jean Dupont');
        $user->setEmail('jean@example.com');
        $user->setSalle($salle1); // Il choisit la salle Horizon
        $manager->persist($user);

        $manager->flush();
    }
}