<?php
namespace Fc\FantaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fc\FantaBundle\Entity\Role;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $role = new Role();
        $role->setCode(0);
        $role->setName('Portiere');
        $manager->persist($role);
        
        $role = new Role();
        $role->setCode(1);
        $role->setName('Difensore');
        $manager->persist($role);
        
        $role = new Role();
        $role->setCode(2);
        $role->setName('Centrocampista');
        $manager->persist($role);
        
        $role = new Role();
        $role->setCode(3);
        $role->setName('Attaccante');
        $manager->persist($role);
        
        $manager->flush();
    }
}