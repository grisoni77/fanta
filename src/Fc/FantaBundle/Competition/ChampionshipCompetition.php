<?php

namespace Fc\FantaBundle\Competition;

use Symfony\Component\Form\Form;

use Fc\FantaBundle\Entity\Competition;
use Fc\FantaBundle\Entity\Round;
use Fc\FantaBundle\Entity\Game;

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
    public function createCompetition() 
    {
        
    }

    /**
     * {@inheritdoc}
     */
    public function createForm($data = null, array $options = array())
    {
        $builder = $this->getFormFactory()->createBuilder('form', $data, $options);
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


    public function generateDays($teams) 
    {
        $ghost = false;
        if ($teams % 2 == 1) {
            $teams++;
            $ghost = true;
        }
        
        // Generate the fixtures using the cyclic algorithm.
        $totalRounds = $teams - 1;
        $matchesPerRound = $teams / 2;
        $rounds = array();//new String[totalRounds][matchesPerRound];
        
        for ($round = 0; $round < $totalRounds; $round++) 
        {
            for ($match = 0; $match < $matchesPerRound; $match++) 
            {
                $home = ($round + $match) % ($teams - 1);
                $away = ($teams - 1 - $match + $round) % ($teams - 1);
                // Last team stays in the same place while the others
                // rotate around it.
                if ($match == 0) {
                    $away = $teams - 1;
                }
                // Add one so teams are number 1 to teams not 0 to teams - 1
                // upon display.
                if (!isset($rounds[$round])) {
                    $rounds[$round] = array();
                }
                $rounds[$round][$match] = array($home + 1, $away + 1);//($home + 1) . " v " . ($away + 1);
            }
        }
        //print_r($rounds);
        
        // Interleave so that home and away games are fairly evenly dispersed.
        $interleaved = array();//new String[totalRounds][matchesPerRound];
        
        $evn = 0;
        $odd = ($teams / 2);
        for ($i = 0; $i < count($rounds); $i++) {
            if ($i % 2 == 0) {
                $interleaved[$i] = $rounds[$evn++];
            } else {
                $interleaved[$i] = $rounds[$odd++];
            }
        }
        
        $rounds = $interleaved;

        // inverte
        $flip = function($match) {
            return array($match[1], $match[0]);
            //$components = explode(' v ', $match);//match.split(" v ");
            //return $components[1] . " v " . $components[0];
        };
        
        // Last team can't be away for every game so flip them
        // to home on odd rounds.
        for ($round = 0; $round < count($rounds); $round++) {
            if ($round % 2 == 1) {
                $rounds[$round][0] = $flip($rounds[$round][0]);
            }
        }
        
        return $rounds;
    }
    
}