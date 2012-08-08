<?php

namespace Fc\FantaBundle\Competition;

use Fc\FantaBundle\Competition\CompetitionInterface;

/**
 * Description of CompetitionFactory
 *
 * @author 71537
 */
class CompetitionFactory
{
    private $competitions;
    private $form_factory;
    
    public function __construct(\Symfony\Component\Form\FormFactory $form_factory)
    {
        $this->competitions = array();
        $this->form_factory = $form_factory;
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
                $comp->setLabel($c['label']);
                $comp->setFormFactory($this->form_factory);
                return $comp;
            }
        }
        return false;
            
    }
    
}