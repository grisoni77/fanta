<?php

namespace Fc\FantaBundle\Competition;

use Fc\FantaBundle\Competition\CompetitionInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of CompetitionFactory
 *
 * @author 71537
 */
class CompetitionFactory
{
    private $competitions;
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
        $this->competitions = array();
        $this->container = $container;
        $this->form_factory = $container->get('form.factory');
        $this->setCompetitions($container->getParameter('fc_fanta.competition_types'));
    }
    
    public function setCompetitions($competitions) {
        $this->competitions = $competitions;                
    }
    
    public function getCompetitionTypes() 
    {
        return $this->container->getParameter('fc_fanta.competition_types');
    }

    /**
     * @param string $name
     * @return Fc\FantaBundle\Competition\CompetitionInterface
     */
    public function getCompetitionBuilder($name)
    {
        foreach ($this->competitions as $c) 
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