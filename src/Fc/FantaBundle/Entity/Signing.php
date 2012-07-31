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
     * @ORM\ManyToOne(targetEntity="Club")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     */
    private $club;
    
    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
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
}