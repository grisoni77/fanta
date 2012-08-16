<?php

namespace Fc\SiteBundle\Wizard;

use Peytz\Wizard\ReportInterface;
use Symfony\Component\Form\Exception\NotValidException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of CompetitionReport
 *
 * @author cris
 * 
 */
class CompetitionReport implements ReportInterface
{
    private $league = null;
    private $name = '';
    private $type = '';
    private $teams = null;
    private $params = array();
    
    public function __get($key) 
    {
        if (array_key_exists($key, $this->params)) {
            return $this->params[$key];
        } else {
            //throw new NotValidException('dato non valido: '.$key);
            return null;
        }
    }
    
    public function __set($key, $value)
    {
        $this->params[$key] = $value;
    }
    
    //put your code here
    public function canCalculateResult() {
        return true;
    }
    
    
    public function setData($data) {
        $this->setName($data['name']);
        $this->setType($data['type']);
        $this->setTeams($data['teams']);
    }
    public function getData() {
        return array(
            'name' => $this->getName(),
            'type' => $this->getType(),
            'teams' => $this->getTeams(),
        );
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    public function getName() {
        return $this->name;
    }
    public function setLeague($league) {
        $this->league = $league;
        return $this;
    }
    public function getLeague() {
        return $this->league;
    }
    public function setType($type) {
        $this->type = $type;
        return $this;
    }
    public function getType() {
        return $this->type;
    }
    public function setTeams($teams) {
        $this->teams = $teams;
        return $this;
    }
    public function getTeams() {
        return $this->teams;
    }
}

?>