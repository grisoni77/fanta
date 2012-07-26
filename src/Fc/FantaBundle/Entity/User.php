<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
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
     * @var string $nickname
     *
     * @ORM\Column(name="nickname", type="string", length=255)
     */
    private $nickname;

    /** 
     * @ORM\ManyToMany(targetEntity="League", inversedBy="users")
     * @ORM\JoinTable(name="Subscription") 
     */
    private $leagues;
    
    /**
     * @ORM\OneToMany(targetEntity="Team", mappedBy="user")
     */
    private $teams;

    
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
     * @return User
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
     * Set nickname
     *
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }
    public function __construct()
    {
        $this->leagues = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add leagues
     *
     * @param Fc\FantaBundle\Entity\League $leagues
     * @return User
     */
    public function addLeague(\Fc\FantaBundle\Entity\League $leagues)
    {
        $this->leagues[] = $leagues;
        return $this;
    }

    /**
     * Remove leagues
     *
     * @param <variableType$leagues
     */
    public function removeLeague(\Fc\FantaBundle\Entity\League $leagues)
    {
        $this->leagues->removeElement($leagues);
    }

    /**
     * Get leagues
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLeagues()
    {
        return $this->leagues;
    }

    /**
     * Add teams
     *
     * @param Fc\FantaBundle\Entity\Team $teams
     * @return User
     */
    public function addTeam(\Fc\FantaBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;
        return $this;
    }

    /**
     * Remove teams
     *
     * @param <variableType$teams
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
}