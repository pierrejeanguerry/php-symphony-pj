<?php 
namespace App\DataFixtures\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('test_user');
        $user->setFirstname('test_user');
        $user->setPassword('test_password');
        $user->setSurname("test_user");
        $user->setCountryCode("FR");
        $user->setrole('rédacteur');
        $user->setRoles(["ROLE_USER"]);

        $manager->persist($user);
        $manager->flush();
    }
}
