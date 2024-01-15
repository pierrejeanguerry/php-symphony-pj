<?php

namespace App\DataFixtures;

use App\Entity\Item;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('piguerry');
        $user->setPassword('piguerry');
        $user->setrole('rédacteur');
        $user->setRoles(["ROLE_USER"]);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('admin');
        $user->setrole('éditeur');
        $user->setRoles(["ADMIN_USER"]);
        $manager->persist($user);

        $item = new Item();
        $item->setName('boots');
        $manager->persist($item);
        $item = new Item();
        $item->setName('helmet');
        $manager->persist($item);
        $item = new Item();
        $item->setName('body armor');
        $manager->persist($item);
        $item = new Item();
        $item->setName('gloves');
        $manager->persist($item);
        $item = new Item();
        $item->setName('weapon');
        $manager->persist($item);
        $item = new Item();
        $item->setName('shield');
        $manager->persist($item);
        $item = new Item();
        $item->setName('ring');
        $manager->persist($item);



        $manager->flush();
    }
}
