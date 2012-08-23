<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\League
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fc\FantaBundle\Repository\LeagueRepository")
 */
class League
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
     * @ORM\ManyToOne(targetEntity="Championship", inversedBy="leagues")
     * @ORM\JoinColumn(name="championship_id", referencedColumnName="id", nullable=false)
     */
    private $championship;
    
    /**
     * @ORM\ManyToOne(targetEntity="Fc\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="owner_user_id", referencedColumnName="id", nullable=false)
     */
    private $owner;
    
    /** 
     * @ORM\OneToMany(targetEntity="Team", mappedBy="league")
     */
    private $teams;

    /**
     * @ORM\OneToMany(targetEntity="Competition", mappedBy="league")
     */
    private $competitions;
    
    /**
     * @var string $open
     *
     * @ORM\Column(name="open", type="boolean")
     */
    private $open;

    
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
     * @return League
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
     * Set championship
     *
     * @param Fc\FantaBundle\Entity\Championship $championship
     * @return League
     */
    public function setChampionship(\Fc\FantaBundle\Entity\Championship $championship = null)
    {
        $this->championship = $championship;
        return $this;
    }

    /**
     * Get championship
     *
     * @return Fc\FantaBundle\Entity\Championship 
     */
    public function getChampionship()
    {
        return $this->championship;
    }
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add competitions
     *
     * @param Fc\FantaBundle\Entity\Competition $competitions
     * @return League
     */
    public function addCompetition(\Fc\FantaBundle\Entity\Competition $competitions)
    {
        $this->competitions[] = $competitions;
        return $this;
    }

    /**
     * Remove competitions
     *
     * @param <variableType$competitions
     */
    public function removeCompetition(\Fc\FantaBundle\Entity\Competition $competitions)
    {
        $this->competitions->removeElement($competitions);
    }

    /**
     * Get competitions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;


    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return League
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
     * Set open
     *
     * @param boolean $open
     * @return League
     */
    public function setOpen($open)
    {
        $this->open = $open;
        return $this;
    }

    /**
     * Get open
     *
     * @return boolean 
     */
    public function getOpen()
    {
        return $this->open;
    }
    
    


    /**
     * Set owner
     *
     * @param Fc\FantaBundle\Entity\User $owner
     * @return League
     */
    public function setOwner(\Fc\UserBundle\Entity\User $owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get owner
     *
     * @return \Fc\UserBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }



    /**
     * Add teams
     *
     * @param Fc\FantaBundle\Entity\Team $teams
     * @return League
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
    
    public function __toString() {
        return $this->getName();
    }
}