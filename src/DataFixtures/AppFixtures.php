<?php

namespace App\DataFixtures;

use App\Entity\Item;
use App\Entity\Tag;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $creator = new User();
        $creator->setFirstname("creator");
        $creator->setSurname("creator");
        $creator->setCountryCode("FR");
        $creator->setUsername('creator');
        $creator->setPassword('piguerry');
        $creator->setrole('rédacteur');
        $creator->setRoles(["ROLE_USER"]);
        $manager->persist($creator);

        $validator = new User();
        $validator->setFirstname("admin");
        $validator->setSurname("admin");
        $validator->setCountryCode("FR");
        $validator->setUsername('admin');
        $validator->setPassword('admin');
        $validator->setrole('éditeur');
        $validator->setRoles(["ROLE_ADMIN"]);
        $manager->persist($validator);

        $user = new User();
        $user->setFirstname("pierre-jean");
        $user->setSurname("guerry");
        $user->setCountryCode("FR");
        $user->setUsername('piguerry');
        $user->setPassword('piguerry');
        $user->setrole('rédacteur');
        $user->setRoles(["ROLE_USER"]);
        $manager->persist($user);

        $weapon = new Tag();
        $weapon->setName("weapon");
        $manager->persist($weapon);

        $tableware = new Tag();
        $tableware->setName("tableware");
        $manager->persist($tableware);

        $armor = new Tag();
        $armor->setName("armor");
        $manager->persist($armor);

        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setValidationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->addTag($armor);
        $item->setCreator($creator);
        $item->setValidator($validator);
        $item->setIsValidated(true);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setValidationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->addTag($armor);
        $item->setCreator($creator);
        $item->setValidator($validator);
        $item->setIsValidated(true);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2020-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('boots');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setPublicationDate(new DateTime("2021-01-01"));
        $item->setDescription("Ceci est un objet très stylé");
        $item->setName('helmet');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2022-01-01"));
        $item->setName('body armor');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setValidationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->addTag($armor);
        $item->setCreator($creator);
        $item->setValidator($validator);
        $item->setIsValidated(true);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setValidationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->addTag($armor);
        $item->setCreator($creator);
        $item->setValidator($validator);
        $item->setIsValidated(true);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2023-01-01"));
        $item->setValidationDate(new DateTime("2023-01-01"));
        $item->setName('gloves');
        $item->addTag($armor);
        $item->setCreator($creator);
        $item->setValidator($validator);
        $item->setIsValidated(true);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2024-01-01"));
        $item->setName('weapon');
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2025-01-01"));
        $item->setName('shield');
        $item->addTag($armor);
        $item->setCreator($creator);
        $manager->persist($item);
        $item = new Item();
        $item->setDescription("Ceci est un objet très stylé");
        $item->setPublicationDate(new DateTime("2026-01-01"));
        $item->setValidationDate(new DateTime("2026-01-01"));
        $item->setName('ring');
        $item->setCreator($creator);
        $item->setValidator($validator);
        $item->setIsValidated(true);
        $manager->persist($item);

        $manager->flush();
    }
}
