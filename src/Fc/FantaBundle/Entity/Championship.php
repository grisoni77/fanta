<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Championship
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Championship
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
     * @var type 
     * 
     * @ORM\ManyToOne(targetEntity="Season", inversedBy="championships")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id", nullable=false)
     */
    private $season;
    
    /**
     * @ORM\OneToMany(targetEntity="Club", mappedBy="championship") 
     */
    private $clubs;
    
    
    /**
     * @ORM\Column(name="is_calendar_frozen", type="boolean")
     */
    private $isCalendarFrozen;
            
    /**
     * @ORM\OneToMany(targetEntity="Day", mappedBy="championship") 
     */
    private $days;
    
    /**
     * @ORM\OneToMany(targetEntity="League", mappedBy="championship") 
     */
    private $leagues;

    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    
    public function __construct()
    {
        $this->clubs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->days = new \Doctrine\Common\Collections\ArrayCollection();
        $this->leagues = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return Championship
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
     * Set season
     *
     * @param Fc\FantaBundle\Entity\Season $season
     * @return Championship
     */
    public function setSeason(\Fc\FantaBundle\Entity\Season $season = null)
    {
        $this->season = $season;
        return $this;
    }

    /**
     * Get season
     *
     * @return Fc\FantaBundle\Entity\Season 
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Add clubs
     *
     * @param Fc\FantaBundle\Entity\Club $clubs
     * @return Championship
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

    /**
     * Add days
     *
     * @param Fc\FantaBundle\Entity\Day $days
     * @return Championship
     */
    public function addDay(\Fc\FantaBundle\Entity\Day $days)
    {
        $this->days[] = $days;
        return $this;
    }

    /**
     * Remove days
     *
     * @param <variableType$days
     */
    public function removeDay(\Fc\FantaBundle\Entity\Day $days)
    {
        $this->days->removeElement($days);
    }

    /**
     * Get days
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDays()
    {
        return $this->days;
    }
    
    public function getDayById($day_id)
    {
        $days = $this->days;
        foreach ($days as $d) {
            if ($d->getId() == $day_id) {
                return $d;
            }
        }
        return null;
    }

    /**
     * Add leagues
     *
     * @param Fc\FantaBundle\Entity\League $leagues
     * @return Championship
     */
    public function addLeague(\Fc\FantaBundle\Entity\League $leagues)
    {
        $this->leagues[] = $leagues;
        return $this;
    }

    /**
     * Remove leagues
     *
     * @param <variableType$leagues
     */
    public function removeLeague(\Fc\FantaBundle\Entity\League $leagues)
    {
        $this->leagues->removeElement($leagues);
    }

    /**
     * Get leagues
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLeagues()
    {
        return $this->leagues;
    }
    
    
    /**
     * Return string description
     * 
     * @return string 
     */
    public function __toString()
    {
        return sprintf("%s - %s", $this->getName(), $this->getSeason());
    }

    

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Championship
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    public function isEnabled()
    {
        return $this->getEnabled();
    }
    
    


    /**
     * Set isCalendarFrozen
     *
     * @param boolean $isCalendarFrozen
     * @return Championship
     */
    public function setIsCalendarFrozen($isCalendarFrozen)
    {
        $this->isCalendarFrozen = $isCalendarFrozen;
        return $this;
    }

    /**
     * Get isCalendarFrozen
     *
     * @return boolean 
     */
    public function getIsCalendarFrozen()
    {
        return $this->isCalendarFrozen;
    }
    public function isCalendarFrozen()
    {
        return $this->getIsCalendarFrozen();
    }
}