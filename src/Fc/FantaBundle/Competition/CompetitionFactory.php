<?php

namespace Fc\FantaBundle\Competition;

use Fc\FantaBundle\Competition\CompetitionInterface;
use Symfony\Component\Form\FormFactory;

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
    
    public function __construct(FormFactory $form_factory)
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