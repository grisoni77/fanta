<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Team
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Club
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
     * @ORM\ManyToOne(targetEntity="Championship", inversedBy="clubs")
     * @ORM\JoinColumn(name="championship_id", referencedColumnName="id")
     */
    private $championship;

    /** 
     * @ORM\ManyToMany(targetEntity="Player", mappedBy="clubs") 
     * @ORM\JoinTable(name="Player_Club")
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
     * Set season
     *
     * @param Fc\FantaBundle\Entity\Season $season
     * @return Team
     */
    public function setSeason(\Fc\FantaBundle\Entity\Season $season = null)
    {
        $this->season = $season;
        return $this;
    }

    /**
     * Get season
     *
     * @return Fc\FantaBundle\Entity\Season 
     */
    public function getSeason()
    {
        return $this->season;
    }
    
    /**
     * Add signings
     *
     * @param Fc\FantaBundle\Entity\Signing $signings
     * @return Team
     */
    public function addSigning(\Fc\FantaBundle\Entity\Signing $signings)
    {
        $this->signings[] = $signings;
        return $this;
    }

    /**
     * Remove signings
     *
     * @param <variableType$signings
     */
    public function removeSigning(\Fc\FantaBundle\Entity\Signing $signings)
    {
        $this->signings->removeElement($signings);
    }

    /**
     * Get signings
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSignings()
    {
        return $this->signings;
    }
    public function __construct()
    {
        $this->signings = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Add players
     *
     * @param Fc\FantaBundle\Entity\Player $players
     * @return Team
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

    /**
     * Set championship
     *
     * @param Fc\FantaBundle\Entity\Championship $championship
     * @return Club
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
}