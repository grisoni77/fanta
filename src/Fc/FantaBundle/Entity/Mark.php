<?php

namespace Fc\FantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fc\FantaBundle\Entity\Mark
 * 
 * Formato voti gazzetta. significato:
 * Codice|giornata|COGNOME nome|Squadra|Trasferito|Ruolo|Presenza|Voto Fc
 * |Minuti inferiore 25|Minuti superiore 25|Voto giornale|Gol segnati
 * |Gol subiti|Gol vittoria|Gol pareggio|Assist|Ammonizione|Espulsione
 * |Rigore tirato|Rigore subito|Rigore parato|Rigore sbagliato|Autogol
 * |Entrato a partita iniziata|Titolare|SV|Gioca in casa|Valore crediti
 *
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="unique_mark", columns={"player_id", "day_id"})})
 * @ORM\Entity
 */
class Mark
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
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="marks")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="Day", inversedBy="marks")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id")
     */
    private $day;

    /**
     * @var integer $trasferito
     *
     * @ORM\Column(name="trasferito", type="boolean")
     */
    private $trasferito;
    /**
     * @var integer $presenza
     *
     * @ORM\Column(name="presenza", type="boolean")
     */
    private $presenza;
    /**
     * @var float $votoFc
     *
     * @ORM\Column(name="votoFc", type="float")
     */
    private $votoFc;
    /**
     * @var integer $minInf25
     *
     * @ORM\Column(name="minInf25", type="boolean")
     */
    private $minInf25;
    /**
     * @var integer $minSup25
     *
     * @ORM\Column(name="minSup25", type="boolean")
     */
    private $minSup25;
    /**
     * @var float $votoGazzetta
     *
     * @ORM\Column(name="votoGazzetta", type="float")
     */
    private $votoGazzetta;
    /**
     * @var integer $goalSegnati
     *
     * @ORM\Column(name="goalSegnati", type="integer")
     */
    private $goalSegnati;
    /**
     * @var integer $goalSubiti
     *
     * @ORM\Column(name="goalSubiti", type="integer")
     */
    private $goalSubiti;
   /**
     * @var integer $goalVittoria
     *
     * @ORM\Column(name="goalVittoria", type="boolean")
     */
     private $goalVittoria;
   /**
     * @var integer $goalPareggio
     *
     * @ORM\Column(name="goalPareggio", type="boolean")
     */
     private $goalPareggio;
    /**
     * @var integer $assist
     *
     * @ORM\Column(name="assist", type="integer")
     */
    private $assist;
    /**
     * @var integer $ammonizione
     *
     * @ORM\Column(name="ammonizione", type="boolean")
     */
    private $ammonizione;
    /**
     * @var integer $espulsione
     *
     * @ORM\Column(name="espulsione", type="boolean")
     */
    private $espulsione;
    /**
     * @var integer $rigoriTirati
     *
     * @ORM\Column(name="rigoriTirati", type="integer")
     */
    private $rigoriTirati;
    /**
     * @var integer $rigoriSubiti
     *
     * @ORM\Column(name="rigoriSubiti", type="integer")
     */
    private $rigoriSubiti;
    /**
     * @var integer $rigoriParati
     *
     * @ORM\Column(name="rigoriParati", type="integer")
     */
    private $rigoriParati;
    /**
     * @var integer $rigoriSbagliati
     *
     * @ORM\Column(name="rigoriSbagliati", type="integer")
     */
    private $rigoriSbagliati;
    /**
     * @var integer $autogoal
     *
     * @ORM\Column(name="autogoal", type="integer")
     */
    private $autogoal;
    /**
     * @var integer $subentrato
     *
     * @ORM\Column(name="subentrato", type="boolean")
     */
    private $subentrato;
    /**
     * @var integer $titolare
     *
     * @ORM\Column(name="titolare", type="boolean")
     */
    private $titolare;
    /**
     * @var integer $senzaVoto
     *
     * @ORM\Column(name="senzaVoto", type="boolean")
     */
    private $senzaVoto;
    /**
     * @var integer $giocaInCasa
     *
     * @ORM\Column(name="giocaInCasa", type="boolean")
     */
    private $giocaInCasa;
     /**
     * @var integer $valoreCrediti
     *
     * @ORM\Column(name="valoreCrediti", type="integer")
     */
   private $valoreCrediti;
            
            
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
     * Set player
     *
     * @param Fc\FantaBundle\Entity\Player $player
     * @return Mark
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
     * Set day
     *
     * @param Fc\FantaBundle\Entity\Day $day
     * @return Mark
     */
    public function setDay(\Fc\FantaBundle\Entity\Day $day = null)
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

    /**
     * Set trasferito
     *
     * @param boolean $trasferito
     * @return Mark
     */
    public function setTrasferito($trasferito)
    {
        $this->trasferito = $trasferito;
        return $this;
    }

    /**
     * Get trasferito
     *
     * @return boolean 
     */
    public function getTrasferito()
    {
        return $this->trasferito;
    }

    /**
     * Set presenza
     *
     * @param boolean $presenza
     * @return Mark
     */
    public function setPresenza($presenza)
    {
        $this->presenza = $presenza;
        return $this;
    }

    /**
     * Get presenza
     *
     * @return boolean 
     */
    public function getPresenza()
    {
        return $this->presenza;
    }

    /**
     * Set votoFc
     *
     * @param float $votoFc
     * @return Mark
     */
    public function setVotoFc($votoFc)
    {
        $this->votoFc = $votoFc;
        return $this;
    }

    /**
     * Get votoFc
     *
     * @return float 
     */
    public function getVotoFc()
    {
        return $this->votoFc;
    }

    /**
     * Set minInf25
     *
     * @param boolean $minInf25
     * @return Mark
     */
    public function setMinInf25($minInf25)
    {
        $this->minInf25 = $minInf25;
        return $this;
    }

    /**
     * Get minInf25
     *
     * @return boolean 
     */
    public function getMinInf25()
    {
        return $this->minInf25;
    }

    /**
     * Set minSup25
     *
     * @param boolean $minSup25
     * @return Mark
     */
    public function setMinSup25($minSup25)
    {
        $this->minSup25 = $minSup25;
        return $this;
    }

    /**
     * Get minSup25
     *
     * @return boolean 
     */
    public function getMinSup25()
    {
        return $this->minSup25;
    }

    /**
     * Set votoGazzetta
     *
     * @param float $votoGazzetta
     * @return Mark
     */
    public function setVotoGazzetta($votoGazzetta)
    {
        $this->votoGazzetta = $votoGazzetta;
        return $this;
    }

    /**
     * Get votoGazzetta
     *
     * @return float 
     */
    public function getVotoGazzetta()
    {
        return $this->votoGazzetta;
    }

    /**
     * Set goalSegnati
     *
     * @param integer $goalSegnati
     * @return Mark
     */
    public function setGoalSegnati($goalSegnati)
    {
        $this->goalSegnati = $goalSegnati;
        return $this;
    }

    /**
     * Get goalSegnati
     *
     * @return integer 
     */
    public function getGoalSegnati()
    {
        return $this->goalSegnati;
    }

    /**
     * Set goalSubiti
     *
     * @param integer $goalSubiti
     * @return Mark
     */
    public function setGoalSubiti($goalSubiti)
    {
        $this->goalSubiti = $goalSubiti;
        return $this;
    }

    /**
     * Get goalSubiti
     *
     * @return integer 
     */
    public function getGoalSubiti()
    {
        return $this->goalSubiti;
    }

    /**
     * Set goalVittoria
     *
     * @param boolean $goalVittoria
     * @return Mark
     */
    public function setGoalVittoria($goalVittoria)
    {
        $this->goalVittoria = $goalVittoria;
        return $this;
    }

    /**
     * Get goalVittoria
     *
     * @return boolean 
     */
    public function getGoalVittoria()
    {
        return $this->goalVittoria;
    }

    /**
     * Set goalPareggio
     *
     * @param boolean $goalPareggio
     * @return Mark
     */
    public function setGoalPareggio($goalPareggio)
    {
        $this->goalPareggio = $goalPareggio;
        return $this;
    }

    /**
     * Get goalPareggio
     *
     * @return boolean 
     */
    public function getGoalPareggio()
    {
        return $this->goalPareggio;
    }

    /**
     * Set assist
     *
     * @param integer $assist
     * @return Mark
     */
    public function setAssist($assist)
    {
        $this->assist = $assist;
        return $this;
    }

    /**
     * Get assist
     *
     * @return integer 
     */
    public function getAssist()
    {
        return $this->assist;
    }

    /**
     * Set ammonizione
     *
     * @param boolean $ammonizione
     * @return Mark
     */
    public function setAmmonizione($ammonizione)
    {
        $this->ammonizione = $ammonizione;
        return $this;
    }

    /**
     * Get ammonizione
     *
     * @return boolean 
     */
    public function getAmmonizione()
    {
        return $this->ammonizione;
    }

    /**
     * Set espulsione
     *
     * @param boolean $espulsione
     * @return Mark
     */
    public function setEspulsione($espulsione)
    {
        $this->espulsione = $espulsione;
        return $this;
    }

    /**
     * Get espulsione
     *
     * @return boolean 
     */
    public function getEspulsione()
    {
        return $this->espulsione;
    }

    /**
     * Set rigoriTirati
     *
     * @param integer $rigoriTirati
     * @return Mark
     */
    public function setRigoriTirati($rigoriTirati)
    {
        $this->rigoriTirati = $rigoriTirati;
        return $this;
    }

    /**
     * Get rigoriTirati
     *
     * @return integer 
     */
    public function getRigoriTirati()
    {
        return $this->rigoriTirati;
    }

    /**
     * Set rigoriSubiti
     *
     * @param integer $rigoriSubiti
     * @return Mark
     */
    public function setRigoriSubiti($rigoriSubiti)
    {
        $this->rigoriSubiti = $rigoriSubiti;
        return $this;
    }

    /**
     * Get rigoriSubiti
     *
     * @return integer 
     */
    public function getRigoriSubiti()
    {
        return $this->rigoriSubiti;
    }

    /**
     * Set rigoriParati
     *
     * @param integer $rigoriParati
     * @return Mark
     */
    public function setRigoriParati($rigoriParati)
    {
        $this->rigoriParati = $rigoriParati;
        return $this;
    }

    /**
     * Get rigoriParati
     *
     * @return integer 
     */
    public function getRigoriParati()
    {
        return $this->rigoriParati;
    }

    /**
     * Set rigoriSbagliati
     *
     * @param integer $rigoriSbagliati
     * @return Mark
     */
    public function setRigoriSbagliati($rigoriSbagliati)
    {
        $this->rigoriSbagliati = $rigoriSbagliati;
        return $this;
    }

    /**
     * Get rigoriSbagliati
     *
     * @return integer 
     */
    public function getRigoriSbagliati()
    {
        return $this->rigoriSbagliati;
    }

    /**
     * Set autogoal
     *
     * @param integer $autogoal
     * @return Mark
     */
    public function setAutogoal($autogoal)
    {
        $this->autogoal = $autogoal;
        return $this;
    }

    /**
     * Get autogoal
     *
     * @return integer 
     */
    public function getAutogoal()
    {
        return $this->autogoal;
    }

    /**
     * Set subentrato
     *
     * @param boolean $subentrato
     * @return Mark
     */
    public function setSubentrato($subentrato)
    {
        $this->subentrato = $subentrato;
        return $this;
    }

    /**
     * Get subentrato
     *
     * @return boolean 
     */
    public function getSubentrato()
    {
        return $this->subentrato;
    }

    /**
     * Set titolare
     *
     * @param boolean $titolare
     * @return Mark
     */
    public function setTitolare($titolare)
    {
        $this->titolare = $titolare;
        return $this;
    }

    /**
     * Get titolare
     *
     * @return boolean 
     */
    public function getTitolare()
    {
        return $this->titolare;
    }

    /**
     * Set senzaVoto
     *
     * @param boolean $senzaVoto
     * @return Mark
     */
    public function setSenzaVoto($senzaVoto)
    {
        $this->senzaVoto = $senzaVoto;
        return $this;
    }

    /**
     * Get senzaVoto
     *
     * @return boolean 
     */
    public function getSenzaVoto()
    {
        return $this->senzaVoto;
    }

    /**
     * Set giocaInCasa
     *
     * @param boolean $giocaInCasa
     * @return Mark
     */
    public function setGiocaInCasa($giocaInCasa)
    {
        $this->giocaInCasa = $giocaInCasa;
        return $this;
    }

    /**
     * Get giocaInCasa
     *
     * @return boolean 
     */
    public function getGiocaInCasa()
    {
        return $this->giocaInCasa;
    }

    /**
     * Set valoreCrediti
     *
     * @param integer $valoreCrediti
     * @return Mark
     */
    public function setValoreCrediti($valoreCrediti)
    {
        $this->valoreCrediti = $valoreCrediti;
        return $this;
    }

    /**
     * Get valoreCrediti
     *
     * @return integer 
     */
    public function getValoreCrediti()
    {
        return $this->valoreCrediti;
    }
}