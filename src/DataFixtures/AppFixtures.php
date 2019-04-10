<?php

namespace App\DataFixtures;

use App\Entity\Title;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadTitle($manager);

    }

    public function loadTitle(ObjectManager $manager)
    {
        $title=new Title();
        $title->setName('Zaproponuj przystanek');

        $manager->persist($title);
        $manager->flush();
    }
}
