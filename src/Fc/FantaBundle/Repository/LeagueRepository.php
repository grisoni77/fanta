<?php

namespace Fc\FantaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fc\UserBundle\Entity\User;
use Fc\FantaBundle\Entity\Subscription;

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
    
    public function findUserTeams(User $user)
    {
        return $user->getTeams();
    }

    /**
     * Ritorna leghe a cui l'utente può iscriversi
     * escludendo quelle a cui è già iscritto
     * 
     * @param \Fc\UserBundle\Entity\User $user
     * @return array
     */
    public function findOpenLeagues(User $user)
    {
        /*
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT l FROM FcFantaBundle:League l
                WHERE 
                s.user != :user 
                ORDER BY l.name ASC'
        )
        ->setParameter('user', $user);

        $leagues = $query->getResult();
        return $leagues;
        */
        return $this->findBy(array('open'=>true, 'enabled'=>true));
    }
    
    public function findOtherLeagues(User $user)
    {
        return $this->findBy(array('open'=>false, 'enabled'=>true));
    }
    
    public function findLeagueCompetitions($league)
    {
        return $this->getEntityManager()->getRepository('FcFantaBundle:Competition')
                ->findBy(array(
                    'league'    => $league,
                    'level'     =>1
                    ));
    }
    
    public function findLeagueTeams($league)
    {
        return $this->getEntityManager()->getRepository('FcFantaBundle:Team')
                ->findBy(array(
                    'league'    => $league
                    ));
    }
    
    public function findFreePlayers($league)
    {
        //$em = $this->getEntityManager();
        
        $qb = $this->createQueryBuilder('p')
                ->select('p')
                //->select('SUM(l.enabled)')
                ->innerJoin('p.currentClub', 'club', Join::WITH, 'club.championship = :champ')
                //->where('club.championship = :champ')
                ->setParameter('champ', $league->getChampionship())
                
                ->leftJoin('p.listings', 'l')
                ->leftJoin('l.team', 't', Join::WITH, 't.league = :league')
                ->setParameter('league', $league)
                
                ->where('l.id IS NULL')
                ->groupBy('p.id')
                //->having('SUM(l.enabled) = \'NULL\' ')
                //->orHaving('SUM(l.enabled) = :null')
                //->setParameter('null', null)
                ->orderBy('p.role, p.name')
        ;

        $players = $qb->getQuery()->getResult();
        return $players;
    }
    
}