<?php
namespace Fc\FantaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fc\FantaBundle\Entity\Role;
use Fc\FantaBundle\Entity\Season;
use Fc\FantaBundle\Entity\Championship;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // inserisci Ruoli giocatori
        $role = new Role();
        $role->setCode(0);
        $role->setName('Portiere');
        $role->setLetter('P');
        $manager->persist($role);
        
        $role = new Role();
        $role->setCode(1);
        $role->setName('Difensore');
        $role->setLetter('D');
        $manager->persist($role);
        
        $role = new Role();
        $role->setCode(2);
        $role->setName('Centrocampista');
        $role->setLetter('C');
        $manager->persist($role);
        
        $role = new Role();
        $role->setCode(3);
        $role->setName('Attaccante');
        $role->setLetter('A');
        $manager->persist($role);
        
        // inserisci stagione/campionati di test
        $season = new Season();
        $season->setTitle('Stagione 2011/2012');
        $season->setEnabled(true);
        $manager->persist($season);
        $champ = new Championship();
        $champ->setName('Serie A TIM');
        $champ->setSeason($season);
        $champ->setEnabled(true);
        $manager->persist($champ);
        
        $season = new Season();
        $season->setTitle('Stagione 2012/2013');
        $season->setEnabled(true);
        $manager->persist($season);
        $champ = new Championship();
        $champ->setName('Serie A TIM');
        $champ->setSeason($season);
        $champ->setEnabled(true);
        $manager->persist($champ);
        
        
        $manager->flush();
    }
}