<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Lineup
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Lineup
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
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", nullable=false)
     */
    private $game;
    
    /**
     * @ORM\ManyToOne(targetEntity="Listing")
     * @ORM\JoinColumn(name="listing_id", referencedColumnName="id", nullable=false)
     */
    private $listing;
    
    /**
     * @var integer $bench
     *
     * @ORM\Column(name="bench", type="integer")
     */
    private $bench;

    /**
     * @var integer $bench_order
     *
     * @ORM\Column(name="bench_order", type="integer")
     */
    private $bench_order;


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
     * Set bench
     *
     * @param integer $bench
     * @return Lineup
     */
    public function setBench($bench)
    {
        $this->bench = $bench;
        return $this;
    }

    /**
     * Get bench
     *
     * @return integer 
     */
    public function getBench()
    {
        return $this->bench;
    }

    /**
     * Set bench_order
     *
     * @param integer $benchOrder
     * @return Lineup
     */
    public function setBenchOrder($benchOrder)
    {
        $this->bench_order = $benchOrder;
        return $this;
    }

    /**
     * Get bench_order
     *
     * @return integer 
     */
    public function getBenchOrder()
    {
        return $this->bench_order;
    }

    /**
     * Set game
     *
     * @param Fc\FantaBundle\Entity\Game $game
     * @return Lineup
     */
    public function setGame(\Fc\FantaBundle\Entity\Game $game = null)
    {
        $this->game = $game;
        return $this;
    }

    /**
     * Get game
     *
     * @return Fc\FantaBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set listing
     *
     * @param Fc\FantaBundle\Entity\Listing $listing
     * @return Lineup
     */
    public function setListing(\Fc\FantaBundle\Entity\Listing $listing = null)
    {
        $this->listing = $listing;
        return $this;
    }

    /**
     * Get listing
     *
     * @return Fc\FantaBundle\Entity\Listing 
     */
    public function getListing()
    {
        return $this->listing;
    }
}