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
     * @ORM\ManyToMany(targetEntity="Fc\FantaBundle\Entity\League", inversedBy="users")
     * @ORM\JoinTable(name="Subscription") 
     */
    private $leagues;
    
    /**
     * @ORM\OneToMany(targetEntity="Fc\FantaBundle\Entity\Team", mappedBy="user")
     */
    private $teams;

    
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