<?php

namespace Fc\FantaBundle\Competition\Builder;

use Fc\FantaBundle\Competition\Builder\CompetitionBuilderInterface;
use Fc\FantaBundle\Competition\CompetitionDataInterface;

use Fc\FantaBundle\Entity\Competition;
use Fc\FantaBundle\Entity\Round;
use Fc\FantaBundle\Entity\Game;
use Fc\FantaBundle\Entity\Day;

/**
 * Description of ChampionshipCompetitionBuilder
 *
 * @author 71537
 */
class ChampionshipCompetitionBuilder extends AbstractCompetitionBuilder 
{

    /**
     * {@inheritdoc}
     */
    public function createForm(CompetitionDataInterface $data = null, array $options = array())
    {
        $options['validation_constraint'] = (array(
            'num_gironi' => new \Fc\FantaBundle\Competition\Constraint\ChampionshipConstraint()
        ));
        $builder = $this->getFormFactory()->createBuilder('form', $data, $options);
        $league = $data->getLeague();
        /* @var $days Doctrine\ORM\PersistentCollection */
        $days = $league->getChampionship()->getDays();
        //Doctrine\ORM\PersistentCollection::
        $choices = array();
        foreach ($days as $d) {
            if ($d->getDate() > new \DateTime('now')) {
                $choices[$d->getId()] = (string) $d;
            }
        }
        $builder
            ->add('num_gironi', null , array(
                'label'     => 'Numero gironi',
                'data'      => 2,
            ))
            ->add('day_from', 'choice' , array(
                'choices' => $choices,
                //'class'     => 'Fc\FantaBundle\Entity\Day',
                'label'     => 'Giornata iniziale',
            ))
            ->add('day_to', 'choice' , array(
                'choices' => $choices,
                //'class'     => 'Fc\FantaBundle\Entity\Day',
                'label'     => 'Giornata finale',
            ))
        ;
        
        $form = $builder->getForm();
        
        return $form;
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function createCompetition(CompetitionDataInterface $data) 
    {
        $em = $this->getEntityManager();
        // crea competition
        $comp = new Competition();
        $comp->setLeague($data->getLeague());
        $comp->setname($data->getName());
        $comp->setLevel(1);
        $comp->setParams(serialize($data->getParams()));
        $comp->setType('championship');
        $comp->setEnabled(false);
        // add teams
        foreach ($data->getTeams() as $tid) 
        {
            $team = $em->getRepository('FcFantaBundle:Team')->find($tid);
            $comp->addTeam($team);
        }
        $em->persist($comp);
        // genera giornate
        $rounds = $this->generateDays(count($comp->getTeams()));
        $teams = $comp->getTeams();
        $params = $data->getParams();
        $d = $params['day_from'];
        $day = $em->getRepository('FcFantaBundle:Day')->find($d);
        //$dnumber = $day->getNumber();
        for ($g=0; $g < $params['num_gironi']; $g++) {
            $inversion = $g%2 == 1;
            foreach ($rounds as $k => $r)
            {
                $round = new Round();
                //echo ($inversion?"R":"A");
                $round->setAbbr((string) sprintf("%d%s%d", $k+1, ($inversion?"R":"A"), ceil(($g+1)/2)));
                $round->setName((string) sprintf("%d° di %s(%d)", $k+1, ($inversion?'ritorno':'andata'), ceil(($g+1)/2)));
                $round->setCompetition($comp);
                $round->setDay($day);
                $round->setOrdering((int)$g*count($rounds)+$k+1);
                
                $em->persist($round);
                foreach ($r as $ga) 
                {
                    $game = new Game();
                    $game->setRound($round);
                    $game->setPlayed(false);
                    $game->setTeam1($teams->get(($inversion ? $ga[1] : $ga[0])-1));
                    $game->setTeam2($teams->get(($inversion ? $ga[0] : $ga[1])-1));
                    $em->persist($game);
                }
                // cerca giornata per turno successivo
                $day = $em->getRepository('FcFantaBundle:Day')->findOneBy(array(
                    'number'=>$day->getNumber(), 
                    'championship'=>$data->getLeague()->getChampionship(),
                ));
                //$dnumber = $day->getNumber();
            }
        }  
        //print_r($rounds);die();
        //save
        $em->flush();
    }
    
    private function generateDays($teams) 
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

    public static function getName() {
        return \Fc\FantaBundle\Competition\ChampionshipCompetition::getName();
    }
    
    public function getDescriptionTemplate() {
        return \Fc\FantaBundle\Competition\ChampionshipCompetition::getDescriptionTemplate();
    }
    
    public function getConcreteDescriptionTemplate() {
        return \Fc\FantaBundle\Competition\ChampionshipCompetition::getConcreteDescriptionTemplate();
    }

    public static function getType() {
        return \Fc\FantaBundle\Competition\ChampionshipCompetition::getType();
    }

}