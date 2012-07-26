<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Round
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Round
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
     * @var string $abbr
     *
     * @ORM\Column(name="abbr", type="string", length=5)
     */
    private $abbr;

    /**
     * @var integer $ordering
     *
     * @ORM\Column(name="ordering", type="integer")
     */
    private $ordering;

    /**
     * @ORM\ManyToOne(targetEntity="Competition", inversedBy="rounds")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="round")
     */
    private $games;
    
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
     * @return Round
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
     * Set abbr
     *
     * @param string $abbr
     * @return Round
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
        return $this;
    }

    /**
     * Get abbr
     *
     * @return string 
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set ordering
     *
     * @param integer $ordering
     * @return Round
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer 
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * Set competition
     *
     * @param Fc\FantaBundle\Entity\Competition $competition
     * @return Round
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
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add games
     *
     * @param Fc\FantaBundle\Entity\Game $games
     * @return Round
     */
    public function addGame(\Fc\FantaBundle\Entity\Game $games)
    {
        $this->games[] = $games;
        return $this;
    }

    /**
     * Remove games
     *
     * @param <variableType$games
     */
    public function removeGame(\Fc\FantaBundle\Entity\Game $games)
    {
        $this->games->removeElement($games);
    }

    /**
     * Get games
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGames()
    {
        return $this->games;
    }
}