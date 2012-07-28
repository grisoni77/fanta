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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="teams")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Competition", inversedBy="teams")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id", nullable=false)
     */
    private $competition;
    
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
     * Set user
     *
     * @param User $user
     * @return Team
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set competition
     *
     * @param Fc\FantaBundle\Entity\Competition $competition
     * @return Team
     */
    public function setCompetition(\Fc\FantaBundle\Entity\Competition $competition = null)
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * Get competition
     *
     * @return Fc\FantaBundle\Entity\Competition 
     */
    public function getCompetition()
    {
        return $this->competition;
    }
    public function __construct()
    {
        $this->listings = new \Doctrine\Common\Collections\ArrayCollection();
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
}