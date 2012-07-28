<?php

namespace Fc\FantaBundle\Entity;

use FOS\UserBundle\Entity\User as FosUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\User
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
     */
    private $name;


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
}
