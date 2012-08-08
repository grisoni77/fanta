<?php

namespace Fc\FantaBundle\Competition;

use Symfony\Component\Form\Form;

/**
 * Description of ChampionshipCompetition
 *
 * @author 71537
 */
class ChampionshipCompetition extends AbstractCompetition
{
    public function __construct() {
        $this->setLabel('Campionato a gironi');
    }    
    
    /**
     * {@inheritdoc}
     */
    public function createCompetition() {
        
    }

    /**
     * {@inheritdoc}
     */
    public function createForm($data = null, array $options = array())
    {
        $builder = $this->getFormFactory()->createBuilder('form', $data, $options);
        $builder
                ->add('name')
                ->add('num_gironi', 'integer')
                ;
        
        return $builder->getForm();
    }

    /**
     * {@inheritdoc}
     */
    public function getParams() {
        
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'championship';
    }


    
}