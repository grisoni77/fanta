<?php

namespace Fc\FantaBundle\Competition;

use Fc\FantaBundle\Competition\CompetitionInterface;

/**
 * Description of CompetitionFactory
 *
 * @author 71537
 */
class CompetitionFactory 
{
    private $competitions;
    
    public function __construct()
    {
        $this->competitions = array();
    }
    
    public function addCompetition(CompetitionInterface $competition, $label = null)
    {
        if (!empty($label)) {
            $competition->setLabel($label);
        } 
        $this->competitions[] = $competition;
    }
    
    public function getCompetitionTypes() 
    {
        return $this->competitions;
    }
}