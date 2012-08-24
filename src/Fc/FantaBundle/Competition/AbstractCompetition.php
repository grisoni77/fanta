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
     * @var FormFactory
     */
    protected $form_factory;
    
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
    public function getEntityManager() {
        return $this->em;
    }
    
    /**
     * {@inheritdoc}     
     */
    public function setEntityManager(EntityManager $manager) {
        $this->em = $manager;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFormFactory() {
        return $this->form_factory;
    }
    
    /**
     * {@inheritdoc}     
     */
    public function setFormFactory(FormFactory $form_factory) {
        $this->form_factory = $form_factory;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getConcreteDescriptionTemplate() {
        return 'FcFantaBundle:Competition:'.$this->getName().'.concrete.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescriptionTemplate() {
        return 'FcFantaBundle:Competition:'.$this->getName().'.html.twig';
    }
    

    /**
     * {@inheritdoc}
     */
    public function getCalendarTemplate() {
        return 'FcFantaBundle:Competition:'.$this->getName().'.calendar.html.twig';
    }
    
}