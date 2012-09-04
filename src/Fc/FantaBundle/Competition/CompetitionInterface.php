<?php

namespace Fc\FantaBundle\Competition;

use \Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityManager;
use Fc\FantaBundle\Competition\CompetitionDataInterface;

/**
 * Interfaccia per classi Competition
 *
 * @author 71537
 */
interface CompetitionInterface
{
    /**
     * Ritorna i parametri relativi alla singola istanza della competizione
     * @return array
     */
    public function getParams();
    
    /**
     * Ritorna il tipo univoco del tipo di competizione
     * (definito in tabella competitionType...serve davvero sta tabella?)
     * 
     * @return string
     */
    public static function getType();    
    
    /**
     * Ritorna il nome univoco del tipo di competizione
     * @return string
     */
    public function getName();    
    
    /**
     * Ritorna descrizione del tipo di competizione
     * @return string
     */
    public function getLabel();
    
    /**
     * Imposta Label
     * @param string $label
     */
    public function setLabel($label);
    
    /**
     * Ritorna template per testo descrittivo del tipo di competizione 
     */
    public static function getDescriptionTemplate();
    
    /**
     * Ritorna nome template per testo descrittivo del tipo di competizione 
     * completo con i parametri dell'istanza
     */
    public static function getConcreteDescriptionTemplate();
    
    /**
     * Ritorna info per costruzione calendario gare 
     */
    public function getCalendar();
    
    /**
     * Ritorna info per risultati (ad es. claassifica girone)
     */
    public function getResults();
    
}