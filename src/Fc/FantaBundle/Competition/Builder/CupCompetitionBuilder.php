<?php

namespace Fc\FantaBundle\Competition\Builder;

use Fc\FantaBundle\Competition\Builder\CompetitionBuilderInterface;
use Fc\FantaBundle\Competition\CompetitionDataInterface;


/**
 * Description of CupCompetitionBuilder
 *
 * @author 71537
 */
class CupCompetitionBuilder  extends AbstractCompetitionBuilder 
{
    public static function getType() {
        return \Fc\FantaBundle\Competition\CupCompetition::getType();
    }    
    
    public function createCompetition(\Fc\FantaBundle\Competition\CompetitionDataInterface $data) {
        
    }

    public function createForm(\Fc\FantaBundle\Competition\CompetitionDataInterface $data, array $options) {
        
    }

    public function getDescriptionTemplate() {
        
    }
}