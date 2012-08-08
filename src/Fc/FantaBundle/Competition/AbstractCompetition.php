<?php

namespace Fc\FantaBundle\Competition;

use \Symfony\Component\Form\FormFactory;

/**
 * Description of AbstractCompetition
 *
 * @author 71537
 */
abstract class AbstractCompetition implements CompetitionInterface
{
    /**
     * @var string 
     */
    private $label;
    
    /**
     * @var FormFactory
     */
    private $form_factory;
    
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
    public function getFormFactory() {
        return $this->form_factory;
    }
    
    /**
     * {@inheritdoc}     * 
     */
    public function setFormFactory(FormFactory $form_factory) {
        $this->form_factory = $form_factory;
        return $this;
    }
    
}