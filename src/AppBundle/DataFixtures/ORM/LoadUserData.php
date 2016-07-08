<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('alxckn');
        $user->setEmail('alexandre.chakroun@gmail.com');
        $user->setFirstName('Alex');
        $user->setLastName('Chaks');
        $user->setPassword('$2a$04$qbRxxn42zk.yQl5RwlLo2OxTOPFbCUU41wIbMhcUOx5CzxYgiIxGq');

        $manager->persist($user);
        $manager->flush();
    }
}