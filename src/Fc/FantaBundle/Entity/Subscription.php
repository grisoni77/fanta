<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Subscription
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Subscription
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
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;
    
    /**
     * @ORM\ManyToOne(targetEntity="Fc\UserBundle\Entity\User", inversedBy="subscriptions")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="League", inversedBy="subscriptions")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $league;

    /**
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;
    

    public function __construct()
    {
        $this->enabled = 0;
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Subscription
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

    /**
     * Set user
     *
     * @param Fc\UserBundle\Entity\User $user
     * @return Subscription
     */
    public function setUser(\Fc\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Fc\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set league
     *
     * @param Fc\FantaBundle\Entity\League $league
     * @return Subscription
     */
    public function setLeague(\Fc\FantaBundle\Entity\League $league = null)
    {
        $this->league = $league;
        return $this;
    }

    /**
     * Get league
     *
     * @return Fc\FantaBundle\Entity\League 
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Set message
     *
     * @param text $message
     * @return Subscription
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }
}