<?php

namespace Fc\FantaBundle\Competition;

/**
 * Description of AbstractCompetition
 *
 * @author 71537
 */
abstract class AbstractCompetition implements CompetitionInterface
{
    private $label;
    
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
    
}