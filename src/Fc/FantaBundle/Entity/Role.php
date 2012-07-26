<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Role
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Role
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
     * @ORM\OneToMany(targetEntity="Player", mappedBy="role")
     */
    private $players;    

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
     * @return Role
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
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add players
     *
     * @param Fc\FantaBundle\Entity\Player $players
     * @return Role
     */
    public function addPlayer(\Fc\FantaBundle\Entity\Player $players)
    {
        $this->players[] = $players;
        return $this;
    }

    /**
     * Remove players
     *
     * @param <variableType$players
     */
    public function removePlayer(\Fc\FantaBundle\Entity\Player $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }
}