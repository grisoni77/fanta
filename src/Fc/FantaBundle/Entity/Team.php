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
     * @ORM\OneToOne(targetEntity="Subscription")
     * @ORM\JoinColumn(name="subscription_id", referencedColumnName="id")
     */
    private $subscription;

    /**
     * @ORM\ManyToMany(targetEntity="Competition", inversedBy="teams")
     * @ORM\JoinTable(name="Competition_Team")
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
     * Set subscription
     *
     * @param Fc\FantaBundle\Entity\Subscription $subscription
     * @return Team
     */
    public function setSubscription(\Fc\FantaBundle\Entity\Subscription $subscription)
    {
        $this->subscription = $subscription;
        return $this;
    }

    /**
     * Get subscription
     *
     * @return Fc\FantaBundle\Entity\Subscription 
     */
    public function getSubscription()
    {
        return $this->subscription;
    }
}