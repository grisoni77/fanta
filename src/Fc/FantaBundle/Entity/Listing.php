<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Listing
 * Contiene ingaggi fanta squadre
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Listing
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
     * @var integer $enabled
     *
     * @ORM\Column(name="enabled", type="integer")
     */
    private $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="listings")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id", nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="listings")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=false)
     */
    private $team;
    
    /**
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)
     */
    private $role;

    /**
     * @ORM\OneToOne(targetEntity="Transaction")
     * @ORM\JoinColumn(name="transaction_id", referencedColumnName="id", nullable=false, onDelete="cascade")
     */
    private $transaction;

    
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
     * Set enabled
     *
     * @param integer $enabled
     * @return Listing
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set player
     *
     * @param Fc\FantaBundle\Entity\Player $player
     * @return Listing
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
     * Set team
     *
     * @param Fc\FantaBundle\Entity\Team $team
     * @return Listing
     */
    public function setTeam(\Fc\FantaBundle\Entity\Team $team = null)
    {
        $this->team = $team;
        return $this;
    }

    /**
     * Get team
     *
     * @return Fc\FantaBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set role
     *
     * @param Fc\FantaBundle\Entity\Role $role
     * @return Listing
     */
    public function setRole(\Fc\FantaBundle\Entity\Role $role = null)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     *
     * @return Fc\FantaBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set transaction
     *
     * @param Fc\FantaBundle\Entity\Transaction $transaction
     * @return Listing
     */
    public function setTransaction(\Fc\FantaBundle\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;
        return $this;
    }

    /**
     * Get transaction
     *
     * @return Fc\FantaBundle\Entity\Transaction 
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

}