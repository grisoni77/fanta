<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\League
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\JoinColumn(name="championship_id", referencedColumnName="id")
     */
    private $championship;
    
    /** 
     * @ORM\ManyToMany(targetEntity="User", mappedBy="leagues") 
     * @ORM\JoinTable(name="subscription")
     */
    private $users;
    
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
     * Add users
     *
     * @param Fc\FantaBundle\Entity\User $users
     * @return League
     */
    public function addUser(\Fc\FantaBundle\Entity\User $users)
    {
        $this->users[] = $users;
        return $this;
    }

    /**
     * Remove users
     *
     * @param <variableType$users
     */
    public function removeUser(\Fc\FantaBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}