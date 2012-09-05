<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Transaction
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Transaction
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
     * @var float $value
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @ORM\OneToOne(targetEntity="TransactionType")
     * @ORM\JoinColumn(name="transactiontype_id", referencedColumnName="id", nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="transactions")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id", nullable=false)
     */
    private $player;
    
    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=false)
     */
    private $team;
    
    /**
     * Reference a operazione associata (ad es. scambio giocatori o acquisto)
     * @ORM\ManyToOne(targetEntity="Operation")
     * 
     */
    private $operation;
    
    /**
     * @ORM\ManyToOne(targetEntity="Day")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id", nullable=false)
     */
    private $day;
    
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
     * Set value
     *
     * @param float $value
     * @return Transaction
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set type
     *
     * @param Fc\FantaBundle\Entity\TransactionType $type
     * @return Transaction
     */
    public function setType(\Fc\FantaBundle\Entity\TransactionType $type = null)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return Fc\FantaBundle\Entity\TransactionType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set player
     *
     * @param Fc\FantaBundle\Entity\Player $player
     * @return Transaction
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
     * @return Transaction
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
     * Set operation
     *
     * @param Fc\FantaBundle\Entity\Operation $operation
     * @return Transaction
     */
    public function setOperation(\Fc\FantaBundle\Entity\Operation $operation = null)
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * Get operation
     *
     * @return Fc\FantaBundle\Entity\Operation 
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set day
     *
     * @param Fc\FantaBundle\Entity\Day $day
     * @return Transaction
     */
    public function setDay(\Fc\FantaBundle\Entity\Day $day)
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