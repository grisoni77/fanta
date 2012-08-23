<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Day
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Day
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
     * @var integer $number
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var datetime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Championship", inversedBy="days")
     * @ORM\JoinColumn(name="championship_id", referencedColumnName="id", nullable=false)
     */
    private $championship;
    
    /**
     * @ORM\OneToMany(targetEntity="Mark", mappedBy="day")
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
     * Set number
     *
     * @param integer $number
     * @return Day
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set date
     *
     * @param datetime $date
     * @return Day
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set championship
     *
     * @param Fc\FantaBundle\Entity\Championship $championship
     * @return Day
     */
    public function setChampionship(\Fc\FantaBundle\Entity\Championship $championship = null)
    {
        $this->championship = $championship;
        return $this;
    }

    /**
     * Get championship
     *
     * @return Fc\FantaBundle\Entity\Championship 
     */
    public function getChampionship()
    {
        return $this->championship;
    }
    public function __construct()
    {
        $this->marks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add marks
     *
     * @param Fc\FantaBundle\Entity\Mark $marks
     * @return Day
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
    
    public function __toString()
    {
        return sprintf("Giornata %02d il %s", $this->getNumber(), $this->getDate()->format('d-m-Y'));
    }
}