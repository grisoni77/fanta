<?php

namespace Fc\FantaBundle\Competition;

use \Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityManager;
use Fc\FantaBundle\Entity\Competition;
use Symfony\Component\Locale\Exception\MethodNotImplementedException;


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
     *
     * @var \Fc\FantaBundle\Entity\Competition
     */
    protected $entity;
    
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
    
    public function setEntity(Competition $entity) {
        $this->entity = $entity;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return isset($this->entity) ? $this->entity->getName() : null;
    }
    

    /**
     * {@inheritdoc}
     */
    public function getCalendarTemplate() {
        return 'FcFantaBundle:Competition:'.$this->getType().'.calendar.html.twig';
    }
    
    
    public function __call($name, $arguments) {
        if (!isset($this->entity)) {
            throw new MethodNotImplementedException('Metodo non trovato: '.$name.'. Nessuna entità competition impostata.');
        } 
        if (method_exists($this->entity, $name)) {
            return call_user_func(array($this->entity, $name), $arguments);
        } else {
            throw new MethodNotImplementedException('Il metodo '.$name.' non è supportato nella classe '.get_class($this));
        }
    }
    
}