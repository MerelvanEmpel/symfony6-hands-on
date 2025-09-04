<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\MicroPost;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $microPost0 = new MicroPost();
        $microPost0->setTitle('Welcome to Poland!');
        $microPost0->setText('Welcome to Poland!');
        $microPost0->setCreated(new DateTime());
        $manager->persist($microPost0);

        $microPost1 = new MicroPost();
        $microPost1->setTitle('Welcome to the US!');
        $microPost1->setText('Welcome to the US!');
        $microPost1->setCreated(new DateTime());
        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to Germany!');
        $microPost2->setText('Welcome to Germany!');
        $microPost2->setCreated(new DateTime());
        $manager->persist($microPost2);

        $manager->flush();
    }
}
