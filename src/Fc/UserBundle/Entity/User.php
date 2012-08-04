<?php

namespace Fc\UserBundle\Entity;

use FOS\UserBundle\Entity\User as FosUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * Fc\UserBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends FosUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     * 
     * @Assert\NotBlank(message="Inserire un nome per favore", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="Inserire un nome più lungo (minimo 3 lettere)", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="Inserire un nome più corto (massimo 255 lettere)", groups={"Registration", "Profile"})
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="Fc\FantaBundle\Entity\Team", mappedBy="user")
     */
    private $teams;
    
    /** 
     * @ORM\OneToMany(targetEntity="Fc\FantaBundle\Entity\Subscription", mappedBy="user")
     */
    private $subscriptions;
    

    
    public function __construct()
    {
        parent::__construct();
        
        $this->leagues = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
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

    /**
     * Add subscriptions
     *
     * @param Fc\FantaBundle\Entity\Subscription $subscriptions
     * @return User
     */
    public function addSubscription(\Fc\FantaBundle\Entity\Subscription $subscriptions)
    {
        $this->subscriptions[] = $subscriptions;
        return $this;
    }

    /**
     * Remove subscriptions
     *
     * @param Fc\FantaBundle\Entity\Subscription $subscriptions
     */
    public function removeSubscription(\Fc\FantaBundle\Entity\Subscription $subscriptions)
    {
        $this->subscriptions->removeElement($subscriptions);
    }

    /**
     * Get subscriptions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }
}