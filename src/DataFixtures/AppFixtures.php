<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use App\Entity\MicroPost;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher) {
    }

    public function load(ObjectManager $manager): void
    {
        $user0 = new User();
        $user0->setEmail('test@test.com');
        $user0->setPassword($this->userPasswordHasher->hashPassword($user0, 'test'));
        $manager->persist($user0);

        $user1 = new User();
        $user1->setEmail('test1@test.com');
        $user1->setPassword($this->userPasswordHasher->hashPassword($user1, 'test'));
        $manager->persist($user1);

        $microPost0 = new MicroPost();
        $microPost0->setTitle('Welcome to Poland!');
        $microPost0->setText('Welcome to Poland!');
        $microPost0->setCreated(new DateTime());
        $microPost0->setAuthor($user0);
        $manager->persist($microPost0);

        $microPost1 = new MicroPost();
        $microPost1->setTitle('Welcome to the US!');
        $microPost1->setText('Welcome to the US!');
        $microPost1->setCreated(new DateTime());
        $microPost1->setAuthor($user0);
        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to Germany!');
        $microPost2->setText('Welcome to Germany!');
        $microPost2->setCreated(new DateTime());
        $microPost2->setAuthor($user1);
        $manager->persist($microPost2);

        $manager->flush();
    }
}
