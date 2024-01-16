<?php

namespace App\DataFixtures;

use App\Entity\Item;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\Id;
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

        $user = new User();
        $user->setUsername('creator');
        $user->setPassword('piguerry');
        $user->setrole('rédacteur');
        $user->setRoles(["ROLE_USER"]);
        $manager->persist($user);

        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2021-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('helmet');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2022-01-01"));
        $item->setName('body armor');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2024-01-01"));
        $item->setName('weapon');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2025-01-01"));
        $item->setName('shield');
        $item->setUser($user);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2026-01-01"));
        $item->setName('ring');
        $item->setUser($user);
        $manager->persist($item);



        $manager->flush();
    }
}
