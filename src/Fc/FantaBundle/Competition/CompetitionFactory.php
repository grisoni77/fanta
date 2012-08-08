<?php

namespace Fc\FantaBundle\Competition;

use Fc\FantaBundle\Competition\CompetitionInterface;

/**
 * Description of CompetitionFactory
 *
 * @author 71537
 */
class CompetitionFactory implements \Symfony\Component\DependencyInjection\ContainerAwareInterface
{
    /**
     * @var  \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;
    private $competitions;
    
    public function __construct()
    {
        $this->competitions = array();
    }
    
    public function addCompetition(CompetitionInterface $competition, $label = null)
    {
        if (!empty($label)) {
            $competition->setLabel($label);
        } 
        $this->competitions[] = $competition;
    }
    
    public function __getCompetitionTypes() 
    {
        return $this->competitions;
    }
    
    public function getCompetitionTypes() 
    {
        print_r($this->container->getParameter('fc_fanta.competitions'));
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
        $this->container = $container;
    }
    
}