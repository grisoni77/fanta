<?php

namespace Fc\FantaBundle\Competition;

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
    public function createForm() {
        
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