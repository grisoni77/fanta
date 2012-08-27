<?php

namespace Fc\FantaBundle\Competition;

use Fc\FantaBundle\Entity\League;

/**
 * Description of CompetitionDataInterface
 *
 * @author 71537
 */
interface CompetitionDataInterface 
{
    /**
     * 
     * @param string $name
     */
    public function setName($name);
    /**
     * @return string
     */
    public function getName();
    public function setLeague(League $league);
    /**
     * @return League
     */
    public function getLeague();
    /**
     * 
     * @param string $type
     */
    public function setType($type);
    public function getType();
    /**
     * 
     * @param array $teams
     */
    public function setTeams($teams);
    public function getTeams();
    /**
     * 
     * @param array $params
     */
    public function setParams($params);
    public function getParams();
}