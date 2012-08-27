<?php

namespace Fc\FantaBundle\Competition\Builder;

use Fc\FantaBundle\Competition\Builder\CompetitionBuilderInterface;
use Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityManager;

/**
 * Description of AbstractCompetitionBuilder
 *
 * @author 71537
 */
abstract class AbstractCompetitionBuilder implements CompetitionBuilderInterface
{
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
    
}