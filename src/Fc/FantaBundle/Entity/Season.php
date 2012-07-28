<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Season
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Season
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Championship", mappedBy="season") 
     */
    private $championships;
    
    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

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
     * Set title
     *
     * @param string $title
     * @return Season
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add teams
     *
     * @param Fc\FantaBundle\Entity\Team $teams
     * @return Season
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
     * Return string description
     * 
     * @return string 
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Add championships
     *
     * @param Fc\FantaBundle\Entity\Championship $championships
     * @return Season
     */
    public function addChampionship(\Fc\FantaBundle\Entity\Championship $championships)
    {
        $this->championships[] = $championships;
        return $this;
    }

    /**
     * Remove championships
     *
     * @param <variableType$championships
     */
    public function removeChampionship(\Fc\FantaBundle\Entity\Championship $championships)
    {
        $this->championships->removeElement($championships);
    }

    /**
     * Get championships
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChampionships()
    {
        return $this->championships;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Season
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
}