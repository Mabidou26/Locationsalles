<?php

namespace App\DataFixtures;

use App\Entity\Messages;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = $manager->getRepository(User::class)->findOneBy([]);

        $message = new Messages();
        $message->setUser($user);
        $message->setContenu('Bonjour, je souhaite réserver une salle.');
        $message->setDateEnvoi(new \DateTime());

        $manager->persist($message);
        $manager->flush();
    }
}


