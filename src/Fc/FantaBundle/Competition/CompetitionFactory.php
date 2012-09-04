<?php

namespace Fc\FantaBundle\Competition;

use Fc\FantaBundle\Competition\CompetitionInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Fc\FantaBundle\Entity\Competition;

/**
 * Description of CompetitionFactory
 *
 * @author 71537
 */
class CompetitionFactory
{
    private $competition_types;
    /**
     * @var Symfony\Component\Form\FormFactory
     */
    private $form_factory;
    
    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface 
     */
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->competition_types = array();
        $this->container = $container;
        $this->form_factory = $container->get('form.factory');
        $this->setCompetitionTypes($container->getParameter('fc_fanta.competition_types'));
    }
    
    public function setCompetitionTypes($competitions) {
        $this->competition_types = $competitions;
        foreach ($this->competition_types as &$type) 
        {
            $type['label'] = call_user_func(array($type['class'], 'getType'));
        }
    }
    
    public function getCompetitionTypes() 
    {
        //return $this->container->getParameter('fc_fanta.competition_types');
        return $this->competition_types;
    }

    /**
     * @param string $name
     * @return Fc\FantaBundle\Competition\CompetitionInterface
     */
    public function getCompetitionBuilder($name)
    {
        foreach ($this->competition_types as $c) 
        {
            if ($c['name']==$name) {
                $className = $c['class'];
                $comp = new $className();
                //$comp->setLabel($c['label']);
                $comp->setFormFactory($this->form_factory);
                $comp->setEntityManager($this->container->get('doctrine')->getEntityManager());
                return $comp;
            }
        }
        return false;
            
    }
    
    
    /**
     *  Ritorna competizione decorata
     * 
     * @param \Fc\FantaBundle\Entity\Competition $competition
     * @return \Fc\FantaBundle\Competition\CompetitionInterface
     */
    public function getDecoratedCompetition(Competition $competition)
    {
        $type = $competition->getType();
        $decorated = new ChampionshipCompetition();
        $decorated->setEntity($competition);
        return $decorated;
    }
    
    
    public function getLeagueTeams($league)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $teams = $em->getRepository('FcFantaBundle:League')->findLeagueTeams($league);
        return $teams;
    }
    
    public function getFormFactory() {
        return $this->form_factory;
    }
    
    public function getServiceContainer() {
        return $this->container;
    }
}