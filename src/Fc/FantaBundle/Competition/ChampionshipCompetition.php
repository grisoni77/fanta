<?php

namespace Fc\FantaBundle\Competition;

use Symfony\Component\Form\Form;
use Symfony\Component\Validator\Constraints\Collection;

use Fc\FantaBundle\Competition\CompetitionDataInterface;

use Fc\FantaBundle\Entity\Competition;
use Fc\FantaBundle\Entity\Round;
use Fc\FantaBundle\Entity\Game;
use Fc\FantaBundle\Entity\Day;


/**
 * Description of ChampionshipCompetition
 *
 * @author 71537
 */
class ChampionshipCompetition extends AbstractCompetition
{
    const type = 'championship';
    
    
    public function __construct() {
        $this->setLabel('Campionato a gironi');
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



    /**
     * {@inheritdoc}
     */
    public static function getType() {
        return self::type;
    }
    
    /**
     * {@inheritdoc}
     */
    public static function getConcreteDescriptionTemplate() {
        return 'FcFantaBundle:Competition:'.self::getType().'.concrete.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescriptionTemplate() {
        return 'FcFantaBundle:Competition:'.self::getType().'.html.twig';
    }
    
    
}