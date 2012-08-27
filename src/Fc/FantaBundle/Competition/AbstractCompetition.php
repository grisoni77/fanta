<?php

namespace Fc\FantaBundle\Competition;

use \Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityManager;

/**
 * Description of AbstractCompetition
 *
 * @author 71537
 */
abstract class AbstractCompetition implements CompetitionInterface
{
    /**
     * Parametri campionato
     *  
     * @var array
     */
    protected $params;
    
    /**
     * @var string 
     */
    protected $label;
    
    /**
     * {@inheritdoc}
     */
    public function getLabel() {
        return $this->label;
    }
    
    /**
     * {@inheritdoc}     * 
     */
    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }
    

    /**
     * {@inheritdoc}
     */
    public function getCalendarTemplate() {
        return 'FcFantaBundle:Competition:'.$this->getName().'.calendar.html.twig';
    }
    
}