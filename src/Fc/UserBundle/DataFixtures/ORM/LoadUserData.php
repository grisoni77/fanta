<?php
namespace Fc\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fc\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Cristiano');
        $user->setEmail('cristiano.cucco@gmail.com');
        $user->setName('admin');
        $user->setPassword('admin');
        $user->addRole('ROLE_USER');
        $user->addRole('ROLE_ADMIN');
        $user->addRole('ROLE_SUPER_ADMIN');
        
        $manager->persist($user);
        $manager->flush();
    }
}