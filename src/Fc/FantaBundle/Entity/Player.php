<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fc\FantaBundle\Repository\PlayerRepository")
 */
class Player
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
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)
     */
    private $role;

    /**
     * @var integer $code
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     *
     * @var integer $quotation
     * 
     * @ORM\Column(name="quotation", type="integer") 
     */
    private $quotation;
    /** 
     * @ORM\OneToMany(targetEntity="Signing", mappedBy="player")
     */
    private $signings;
    
    /**
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="currentPlayers")
     * @ORM\JoinColumn(name="current_club_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $currentClub;
    
    /**
     * @ORM\OneToMany(targetEntity="Mark", mappedBy="player")
     */
    private $marks;
    
    /**
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="player")
     */
    private $transactions;

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
     * @return Player
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
     * Set role_id
     *
     * @param integer $roleId
     * @return Player
     */
    public function setRoleId($roleId)
    {
        $this->role_id = $roleId;
        return $this;
    }

    /**
     * Get role_id
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return Player
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set team_id
     *
     * @param integer $teamId
     * @return Player
     */
    public function setTeamId($teamId)
    {
        $this->team_id = $teamId;
        return $this;
    }

    /**
     * Get team_id
     *
     * @return integer 
     */
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * Set role
     *
     * @param Fc\FantaBundle\Entity\Role $role
     * @return Player
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
     * Add signings
     *
     * @param Fc\FantaBundle\Entity\Signing $signings
     * @return Player
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

    /**
     * Add marks
     *
     * @param Fc\FantaBundle\Entity\Mark $marks
     * @return Player
     */
    public function addMark(\Fc\FantaBundle\Entity\Mark $marks)
    {
        $this->marks[] = $marks;
        return $this;
    }

    /**
     * Remove marks
     *
     * @param <variableType$marks
     */
    public function removeMark(\Fc\FantaBundle\Entity\Mark $marks)
    {
        $this->marks->removeElement($marks);
    }

    /**
     * Get marks
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMarks()
    {
        return $this->marks;
    }
    public function __construct()
    {
        $this->listings     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->signings     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->marks        = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add listings
     *
     * @param Fc\FantaBundle\Entity\Listing $listings
     * @return Player
     */
    public function addListing(\Fc\FantaBundle\Entity\Listing $listings)
    {
        $this->listings[] = $listings;
        return $this;
    }

    /**
     * Remove listings
     *
     * @param <variableType$listings
     */
    public function removeListing(\Fc\FantaBundle\Entity\Listing $listings)
    {
        $this->listings->removeElement($listings);
    }

    /**
     * Get listings
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getListings()
    {
        return $this->listings;
    }

    /**
     * Add transactions
     *
     * @param Fc\FantaBundle\Entity\Transaction $transactions
     * @return Player
     */
    public function addTransaction(\Fc\FantaBundle\Entity\Transaction $transactions)
    {
        $this->transactions[] = $transactions;
        return $this;
    }

    /**
     * Remove transactions
     *
     * @param <variableType$transactions
     */
    public function removeTransaction(\Fc\FantaBundle\Entity\Transaction $transactions)
    {
        $this->transactions->removeElement($transactions);
    }

    /**
     * Get transactions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Set currentClub
     *
     * @param Fc\FantaBundle\Entity\Club $currentClub
     * @return Player
     */
    public function setCurrentClub(\Fc\FantaBundle\Entity\Club $currentClub = null)
    {
        $this->currentClub = $currentClub;
        return $this;
    }

    /**
     * Get currentClub
     *
     * @return Fc\FantaBundle\Entity\Club 
     */
    public function getCurrentClub()
    {
        return $this->currentClub;
    }
    
    public function isCurrentClub(Club $club) {
        $curr = $this->getCurrentClub();
        //print_r($curr->getName());
        //print_r($club->getName());
        //echo '<br/>';
        //die();
        return $club->getId() == $curr->getId();
    }
    
    
    public function __toString()
    {
        return sprintf("%s %s", 
                $this->getRole()->getLetter(), 
                $this->getName()
        );
    }

    /**
     * Set quotation
     *
     * @param integer $quotation
     * @return Player
     */
    public function setQuotation($quotation)
    {
        $this->quotation = $quotation;
        return $this;
    }

    /**
     * Get quotation
     *
     * @return integer 
     */
    public function getQuotation()
    {
        return $this->quotation;
    }
}