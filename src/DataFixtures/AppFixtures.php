<?php

namespace App\DataFixtures;

use App\Entity\Action;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $action = new Action();
        $action->setNom("Amazon");
        $action->setPrix(189);
        $action->setDateAchat((new \DateTime('2023-12-12')));
        $manager->persist($action);

        $action = new Action();
        $action->setNom("Tesla");
        $action->setPrix(205);
        $action->setDateAchat((new \DateTime('2023-12-12')));
        $manager->persist($action);

        $action = new Action();
        $action->setNom("Apple");
        $action->setPrix(175);
        $action->setDateAchat((new \DateTime('2023-12-12')));
        $manager->persist($action);
        $manager->flush();
    }
}
