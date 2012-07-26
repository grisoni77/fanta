<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Mark
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mark
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
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="marks")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="Day", inversedBy="marks")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id")
     */
    private $day;

    /**
     * @var float $mark
     *
     * @ORM\Column(name="mark", type="float")
     */
    private $mark;
    
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
     * Set mark
     *
     * @param float $mark
     * @return Mark
     */
    public function setMark($mark)
    {
        $this->mark = $mark;
        return $this;
    }

    /**
     * Get mark
     *
     * @return float 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set player
     *
     * @param Fc\FantaBundle\Entity\Player $player
     * @return Mark
     */
    public function setPlayer(\Fc\FantaBundle\Entity\Player $player = null)
    {
        $this->player = $player;
        return $this;
    }

    /**
     * Get player
     *
     * @return Fc\FantaBundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set day
     *
     * @param Fc\FantaBundle\Entity\Day $day
     * @return Mark
     */
    public function setDay(\Fc\FantaBundle\Entity\Day $day = null)
    {
        $this->day = $day;
        return $this;
    }

    /**
     * Get day
     *
     * @return Fc\FantaBundle\Entity\Day 
     */
    public function getDay()
    {
        return $this->day;
    }
}