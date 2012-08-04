<?php

namespace Fc\FantaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fc\UserBundle\Entity\User;


/**
 * LeagueRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LeagueRepository extends EntityRepository
{
    /**
     * 
     * @param \Fc\UserBundle\Entity\User $user
     * @return array League
     */
    public function findUserLeagues(User $user)
    {
        $leagues = $this->findBy(array('owner'=>$user));
        return $leagues;
    }
    
    public function findSubscriptedLeagues(User $user)
    {
        return $user->getSubscriptions();
    }

    public function findOpenLeagues(User $user)
    {
        return $this->findBy(array('open'=>true, 'enabled'=>true));
    }
    
    public function findOtherLeagues(User $user)
    {
        return $this->findBy(array('open'=>false, 'enabled'=>true));
    }
}