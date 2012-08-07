<?php

namespace Fc\FantaBundle\Competition;

/**
 * Description of ChampionshipCompetition
 *
 * @author 71537
 */
class CupCompetition extends AbstractCompetition
{
    public function __construct() {
        $this->setLabel('Coppa');
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
        return 'cup';
    }


    
}