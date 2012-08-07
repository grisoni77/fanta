<?php

namespace Fc\FantaBundle\Competition;

/**
 * Interfaccia per classi Competition
 *
 * @author 71537
 */
interface CompetitionInterface
{
    /**
     * @return Symfony\Component\Form\Form
     */
    public function createForm();
    
    /**
     * Genera competizione (incluse le figlie se ci sono) e relative giornate
     */
    public function createCompetition();
    
    /**
     * Ritorna i parametri relativi alla singola istanza della competizione
     * @return array
     */
    public function getParams();
    
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
    
}