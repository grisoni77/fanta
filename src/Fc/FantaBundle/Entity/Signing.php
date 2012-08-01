<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Signing
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Signing
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
     * @ORM\ManyToOne(targetEntity="Day")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id", nullable=true)
     */
    private $day;
    
    /**
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="signings")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $club;
    
    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="signings")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $player;

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
     * Set day
     *
     * @param Fc\FantaBundle\Entity\Day $day
     * @return Signing
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

    /**
     * Set club
     *
     * @param Fc\FantaBundle\Entity\Club $club
     * @return Signing
     */
    public function setClub(\Fc\FantaBundle\Entity\Club $club = null)
    {
        $this->club = $club;
        return $this;
    }

    /**
     * Get club
     *
     * @return Fc\FantaBundle\Entity\Club 
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set player
     *
     * @param Fc\FantaBundle\Entity\Player $player
     * @return Signing
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
    
    public function __toString()
    {
        return sprintf("%s al club %s dalla giornata %d",
                $this->getPlayer()->getName(),
                $this->getClub(),
                $this->getDay()->getNumber()
        );
    }
    
    public function toStringPlayer()
    {
        return sprintf("al club %s dalla giornata %d",
                $this->getClub(),
                $this->getDay()->getNumber()
        );
    }
    
}