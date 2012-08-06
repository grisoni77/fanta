<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Team
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Team
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
     * @ORM\ManyToOne(targetEntity="Fc\UserBundle\Entity\User", inversedBy="teams")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="League"), inversedBy="teams")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id", nullable=false)
     */
    private $league;

    /**
     * @ORM\ManyToMany(targetEntity="Competition", inversedBy="teams")
     */
    private $competitions;
    
    /**
     * @ORM\OneToMany(targetEntity="Listing", mappedBy="team")
     */
    private $listings;
    
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
     * @return Team
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
     * Add listings
     *
     * @param Fc\FantaBundle\Entity\Listing $listings
     * @return Team
     */
    public function addListing(\Fc\FantaBundle\Entity\Listing $listings)
    {
        $this->listings[] = $listings;
        return $this;
    }

    /**
     * Remove listings
     *
     * @param <variableType$listings
     */
    public function removeListing(\Fc\FantaBundle\Entity\Listing $listings)
    {
        $this->listings->removeElement($listings);
    }

    /**
     * Get listings
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getListings()
    {
        return $this->listings;
    }

    /**
     * Set user
     *
     * @param Fc\UserBundle\Entity\User $user
     * @return Team
     */
    public function setUser(\Fc\UserBundle\Entity\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Fc\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    
    public function __construct()
    {
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->listings = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add competitions
     *
     * @param Fc\FantaBundle\Entity\Competition $competitions
     * @return Team
     */
    public function addCompetition(\Fc\FantaBundle\Entity\Competition $competitions)
    {
        $this->competitions[] = $competitions;
        return $this;
    }

    /**
     * Remove competitions
     *
     * @param Fc\FantaBundle\Entity\Competition $competitions
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
     * Set league
     *
     * @param Fc\FantaBundle\Entity\League $league
     * @return Team
     */
    public function setLeague(\Fc\FantaBundle\Entity\League $league)
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
}