<?php
namespace Fc\FantaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fc\FantaBundle\Entity\Role;
use Fc\FantaBundle\Entity\Season;
use Fc\FantaBundle\Entity\Championship;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData implements FixtureInterface, OrderedFixtureInterface
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
        
        // Inserisci competiotion types
        $comptype = new \Fc\FantaBundle\Entity\CompetitionType();
        $comptype->setName('Campionato');
        $manager->persist($comptype);
        $comptype = new \Fc\FantaBundle\Entity\CompetitionType();
        $comptype->setName('Playoff');
        $manager->persist($comptype);
        $comptype = new \Fc\FantaBundle\Entity\CompetitionType();
        $comptype->setName('Coppa');
        $manager->persist($comptype);
        
        // inserisci stagione/campionati di test
        $season = new Season();
        $season->setTitle('Stagione 2011/2012');
        $season->setEnabled(false);
        $manager->persist($season);
        $champ = new Championship();
        $champ->setName('Serie A TIM');
        $champ->setSeason($season);
        $champ->setEnabled(true);
        $champ->setIsCalendarFrozen(false);
        $manager->persist($champ);
        
        $season = new Season();
        $season->setTitle('Stagione 2012/2013');
        $season->setEnabled(true);
        $manager->persist($season);
        $champ = new Championship();
        $champ->setName('Serie A TIM');
        $champ->setSeason($season);
        $champ->setEnabled(true);
        $champ->setIsCalendarFrozen(false);
        $manager->persist($champ);
        
        // crea lega
        $league = new \Fc\FantaBundle\Entity\League();
        $league->setName('Fantalega Fumante');
        $league->setChampionship($champ);
        $user = $manager->getRepository('FcUserBundle:User')->findOneBy(array('username'=>'user1'));
        $league->setOwner($user);
        $league->setEnabled(true);
        $league->setOpen(false);
        $manager->persist($league);
        for ($i=1; $i<9 ; $i++) {
            $user = $manager->getRepository('FcUserBundle:User')->findOneBy(array('username'=>'user'.$i));
            /*
            $subscription = new \Fc\FantaBundle\Entity\Subscription();
            $subscription->setEnabled(true);
            $subscription->setLeague($league);
            $subscription->setUser($user);
            $subscription->setMessage('Messaggio fittizio...');
            $manager->persist($subscription);
            */ 
            // crea il team con nome fittizio
            $team = new \Fc\FantaBundle\Entity\Team();
            $team->setName($user.'\'s team');
            $team->setLeague($league);
            $team->setUser($user);
            $team->setEnabled(true);
            $team->setMessage('Messaggio fittizio...');
            $manager->persist($team);            
        }
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 2; // ordine in cui le fixture saranno caricate
    }
}