<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $action = new Action();
        $action->setNom($faker->city);
        $action->setDateAchat(new Date);

        $manager->flush();
    }
}
