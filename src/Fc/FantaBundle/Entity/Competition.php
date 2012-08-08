<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Competition
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Competition
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="CompetitionType")
     * @ORM\JoinColumn(name="competitiontype_id", referencedColumnName="id", nullable=false)
     */
    private $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="League", inversedBy="competitions")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id", nullable=false)
     */
    private $league;
    
    /**
     * @ORM\OneToMany(targetEntity="Round", mappedBy="competition")
     */
    private $rounds;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="competitions")
     */
    private $teams;
    
    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(name="level", type="integer")
     */
    private $level;
    
    /**
     * @ORM\Column(name="params", type="text")
     */
    private $params;
    
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
     * Set name
     *
     * @param string $name
     * @return Competition
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set league
     *
     * @param Fc\FantaBundle\Entity\League $league
     * @return Competition
     */
    public function setLeague(\Fc\FantaBundle\Entity\League $league = null)
    {
        $this->league = $league;
        return $this;
    }

    /**
     * Get league
     *
     * @return Fc\FantaBundle\Entity\League 
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Add rounds
     *
     * @param Fc\FantaBundle\Entity\Round $rounds
     * @return Competition
     */
    public function addRound(\Fc\FantaBundle\Entity\Round $rounds)
    {
        $this->rounds[] = $rounds;
        return $this;
    }

    /**
     * Remove rounds
     *
     * @param <variableType$rounds
     */
    public function removeRound(\Fc\FantaBundle\Entity\Round $rounds)
    {
        $this->rounds->removeElement($rounds);
    }

    /**
     * Get rounds
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRounds()
    {
        return $this->rounds;
    }


    /**
     * Set type
     *
     * @param Fc\FantaBundle\Entity\CompetitionType $type
     * @return Competition
     */
    public function setType(\Fc\FantaBundle\Entity\CompetitionType $type = null)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return Fc\FantaBundle\Entity\CompetitionType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Competition
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Competition
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }
    
    
    public function __construct()
    {
        $this->rounds = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add teams
     *
     * @param Fc\FantaBundle\Entity\Team $teams
     * @return Competition
     */
    public function addTeam(\Fc\FantaBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;
        return $this;
    }

    /**
     * Remove teams
     *
     * @param Fc\FantaBundle\Entity\Team $teams
     */
    public function removeTeam(\Fc\FantaBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set params
     *
     * @param text $params
     * @return Competition
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Get params
     *
     * @return text 
     */
    public function getParams()
    {
        return $this->params;
    }
}