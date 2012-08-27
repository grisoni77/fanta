<?php

namespace Fc\FantaBundle\Competition\Builder;

use Fc\FantaBundle\Competition\CompetitionDataInterface;
use Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityManager;

/**
 * Description of CompetitionBuilderInterface
 *
 * @author 71537
 */
interface CompetitionBuilderInterface 
{
    
    public function getEntityManager();
    
    public function setEntityManager(EntityManager $manager);
    
    /**
     * @return FormFactory
     */
    public function getFormFactory();
    
    /**
     * Set Form factory service 
     */
    public function setFormFactory(FormFactory $form_factory);
    
    /**
     * @return Symfony\Component\Form\Form
     */
    public function createForm(CompetitionDataInterface $data, array $options);
    
    /**
     * Genera competizione (incluse le figlie se ci sono) e relative giornate
     */
    public function createCompetition(CompetitionDataInterface $data);
    
    /**
     * @return string name of the template
     */
    public function getDescriptionTemplate();
    
}