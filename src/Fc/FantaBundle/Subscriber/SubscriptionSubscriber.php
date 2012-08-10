<?php

namespace Fc\FantaBundle\Subscriber;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use Fc\FantaBundle\Entity\Subscription;
use Fc\FantaBundle\Entity\Team;

/**
 * Description of SubscriptionSubscriber
 *
 * @author 71537
 */
class SubscriptionSubscriber implements EventSubscriber
{
    public function getSubscribedEvents() {
        //return array();
        return array('prePersist');
    }
    
    public function prePersist(LifecycleEventArgs $args)
    {
        //echo 'here I am, dancing like a hurricane!';
        $em = $args->getEntityManager();
        $entity = $args->getEntity();
        
        if ($entity instanceof Subscription) 
        {
            $user = $entity->getUser();
            $league = $entity->getLeague();
            // verifica che non esista già una squadra
            $team = $em->getRepository('FcFantaBundle:Team')->findOneBy(array(
                'user' => $user,
                'league' => $league,
            ));
            if (!$team) 
            {
                // crea il team con nome fittizio
                $team = new Team();
                $team->setName($user.'\'s team');
                $team->setLeague($league);
                $team->setUser($user);
                $em->persist($team);     
                //$em->flush();
            }
        }
    }
    
    public function preRemove(LifecycleEventArgs $args)
    {
        //echo 'here I am, dancing like a hurricane!';
        $em = $args->getEntityManager();
        $entity = $args->getEntity();
        
        if ($entity instanceof Subscription) 
        {
            $user = $entity->getUser();
            $league = $entity->getLeague();
            // verifica che non esista già una squadra
            $team = $em->getRepository('FcFantaBundle:Team')->findOneBy(array(
                'user' => $user,
                'league' => $league,
            ));
            $em->remove($team);
        }        
    }
    
}