<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Player
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="players")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $role;

    /**
     * @var integer $code
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /** 
     * @ORM\ManyToMany(targetEntity="Club", inversedBy="players")
     * @ORM\JoinTable(name="player_club") 
     */
    private $clubs;
    
    /**
     * @ORM\OneToMany(targetEntity="Mark", mappedBy="player")
     */
    private $marks;
    

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
        $this->signings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->marks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Add teams
     *
     * @param Fc\FantaBundle\Entity\Team $teams
     * @return Player
     */
    public function addTeam(\Fc\FantaBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;
        return $this;
    }

    /**
     * Remove teams
     *
     * @param <variableType$teams
     */
    public function removeTeam(\Fc\FantaBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Add clubs
     *
     * @param Fc\FantaBundle\Entity\Club $clubs
     * @return Player
     */
    public function addClub(\Fc\FantaBundle\Entity\Club $clubs)
    {
        $this->clubs[] = $clubs;
        return $this;
    }

    /**
     * Remove clubs
     *
     * @param <variableType$clubs
     */
    public function removeClub(\Fc\FantaBundle\Entity\Club $clubs)
    {
        $this->clubs->removeElement($clubs);
    }

    /**
     * Get clubs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getClubs()
    {
        return $this->clubs;
    }
}