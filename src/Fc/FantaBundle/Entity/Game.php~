<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Game
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Game
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Round", inversedBy="games")
     * @ORM\JoinColumn(name="round_id", referencedColumnName="id")
     */
    private $round;
    
    /**
     * @ORM\OneToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team_1_id", referencedColumnName="id")
     */
    private $team_1;

    /**
     * @ORM\OneToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team_2_id", referencedColumnName="id")
     */
    private $team_2;

    /**
     * @var float $team_1_partial
     *
     * @ORM\Column(name="team_1_partial", type="float")
     */
    private $team_1_partial;

    /**
     * @var float $team_2_partial
     *
     * @ORM\Column(name="team_2_partial", type="float")
     */
    private $team_2_partial;

    /**
     * @var float $team_1_total
     *
     * @ORM\Column(name="team_1_total", type="float")
     */
    private $team_1_total;

    /**
     * @var float $team_2_total
     *
     * @ORM\Column(name="team_2_total", type="float")
     */
    private $team_2_total;

    /**
     * @var integer $team_1_goals
     *
     * @ORM\Column(name="team_1_goals", type="integer")
     */
    private $team_1_goals;

    /**
     * @var integer $team_2_goals
     *
     * @ORM\Column(name="team_2_goals", type="integer")
     */
    private $team_2_goals;

    /**
     * @var integer $played
     *
     * @ORM\Column(name="played", type="integer")
     */
    private $played;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set team_1_partial
     *
     * @param float $team1Partial
     * @return Game
     */
    public function setTeam1Partial($team1Partial)
    {
        $this->team_1_partial = $team1Partial;
        return $this;
    }

    /**
     * Get team_1_partial
     *
     * @return float 
     */
    public function getTeam1Partial()
    {
        return $this->team_1_partial;
    }

    /**
     * Set team_2_partial
     *
     * @param float $team2Partial
     * @return Game
     */
    public function setTeam2Partial($team2Partial)
    {
        $this->team_2_partial = $team2Partial;
        return $this;
    }

    /**
     * Get team_2_partial
     *
     * @return float 
     */
    public function getTeam2Partial()
    {
        return $this->team_2_partial;
    }

    /**
     * Set team_1_total
     *
     * @param float $team1Total
     * @return Game
     */
    public function setTeam1Total($team1Total)
    {
        $this->team_1_total = $team1Total;
        return $this;
    }

    /**
     * Get team_1_total
     *
     * @return float 
     */
    public function getTeam1Total()
    {
        return $this->team_1_total;
    }

    /**
     * Set team_2_total
     *
     * @param float $team2Total
     * @return Game
     */
    public function setTeam2Total($team2Total)
    {
        $this->team_2_total = $team2Total;
        return $this;
    }

    /**
     * Get team_2_total
     *
     * @return float 
     */
    public function getTeam2Total()
    {
        return $this->team_2_total;
    }

    /**
     * Set team_1_goals
     *
     * @param integer $team1Goals
     * @return Game
     */
    public function setTeam1Goals($team1Goals)
    {
        $this->team_1_goals = $team1Goals;
        return $this;
    }

    /**
     * Get team_1_goals
     *
     * @return integer 
     */
    public function getTeam1Goals()
    {
        return $this->team_1_goals;
    }

    /**
     * Set team_2_goals
     *
     * @param integer $team2Goals
     * @return Game
     */
    public function setTeam2Goals($team2Goals)
    {
        $this->team_2_goals = $team2Goals;
        return $this;
    }

    /**
     * Get team_2_goals
     *
     * @return integer 
     */
    public function getTeam2Goals()
    {
        return $this->team_2_goals;
    }

    /**
     * Set played
     *
     * @param integer $played
     * @return Game
     */
    public function setPlayed($played)
    {
        $this->played = $played;
        return $this;
    }

    /**
     * Get played
     *
     * @return integer 
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set round
     *
     * @param Fc\FantaBundle\Entity\Round $round
     * @return Game
     */
    public function setRound(\Fc\FantaBundle\Entity\Round $round = null)
    {
        $this->round = $round;
        return $this;
    }

    /**
     * Get round
     *
     * @return Fc\FantaBundle\Entity\Round 
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Set team_1
     *
     * @param Fc\FantaBundle\Entity\Team $team1
     * @return Game
     */
    public function setTeam1(\Fc\FantaBundle\Entity\Team $team1 = null)
    {
        $this->team_1 = $team1;
        return $this;
    }

    /**
     * Get team_1
     *
     * @return Fc\FantaBundle\Entity\Team 
     */
    public function getTeam1()
    {
        return $this->team_1;
    }

    /**
     * Set team_2
     *
     * @param Fc\FantaBundle\Entity\Team $team2
     * @return Game
     */
    public function setTeam2(\Fc\FantaBundle\Entity\Team $team2 = null)
    {
        $this->team_2 = $team2;
        return $this;
    }

    /**
     * Get team_2
     *
     * @return Fc\FantaBundle\Entity\Team 
     */
    public function getTeam2()
    {
        return $this->team_2;
    }
}