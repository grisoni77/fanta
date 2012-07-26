<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Transaction
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * Reference a transaction associata (ad es. in caso di scambio giocatori)
     * @ORM\ManyToOne(targetEntity="Transaction")
     * @ORM\JoinColumn(name="rel_transaction_id", referencedColumnName="id", nullable=false)
     */
    private $rel_transaction;
    
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
     * Set rel_transaction
     *
     * @param Fc\FantaBundle\Entity\Transaction $relTransaction
     * @return Transaction
     */
    public function setRelTransaction(\Fc\FantaBundle\Entity\Transaction $relTransaction)
    {
        $this->rel_transaction = $relTransaction;
        return $this;
    }

    /**
     * Get rel_transaction
     *
     * @return Fc\FantaBundle\Entity\Transaction 
     */
    public function getRelTransaction()
    {
        return $this->rel_transaction;
    }
}