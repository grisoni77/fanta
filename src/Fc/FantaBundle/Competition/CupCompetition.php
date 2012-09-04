<?php

namespace Fc\FantaBundle\Competition;

/**
 * Description of ChampionshipCompetition
 *
 * @author 71537
 */
class CupCompetition extends AbstractCompetition
{
    const type = 'cup';
    
    
    public function __construct() {
        $this->setLabel('Coppa');
    }    

    /**
     * {@inheritdoc}
     */
    public function getParams() {
        
    }


    public function getCalendar() {
        
    }

    public function getResults() {
        
    }

    public static function getType() {
        return self::type;
    }

    public static function getConcreteDescriptionTemplate() {
        
    }

    public static function getDescriptionTemplate() {
        
    }


    
}