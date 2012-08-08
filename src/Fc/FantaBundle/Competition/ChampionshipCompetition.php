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
        $this->params = array(
            'num_teams' => array(
                'label'     => 'Numero squadre',
                'type'      => 'integer',
                'default'   => 8
            ),
            'num_gironi' => array(
                'label'     => 'Numero gironi',
                'type'      => 'integer',
                'default'   => 2
            )
        );
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
                ->add('name', null, array(
                    'label' => 'Nome competizione'
                ))
                ;
        foreach ($this->params as $name => $p) {
            $builder->add($name, $p['type'], array(
                'label' => $p['label'],
                'data'  => $p['default']
            ));
        }
        
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

    /**
     * {@inheritdoc}
     */
    public function getCalendar() {
        
    }

    /**
     * {@inheritdoc}
     */
    public function getResults() {
        
    }



    
}