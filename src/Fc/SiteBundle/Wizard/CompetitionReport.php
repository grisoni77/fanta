<?php

namespace Fc\SiteBundle\Wizard;

use Peytz\Wizard\ReportInterface;
use Fc\FantaBundle\Competition\CompetitionDataInterface;
use Symfony\Component\Form\Exception\NotValidException;
use Doctrine\ORM\EntityManager;
use Fc\FantaBundle\Entity\League;

/**
 * Description of CompetitionReport
 *
 * @author cris
 * 
 */
class CompetitionReport implements ReportInterface, CompetitionDataInterface
{
    /* @var em EntityManager */
    private $em = null;
    
    private $league = null;
    private $name = '';
    private $type = '';
    private $teams = null;
    private $params = array();
    
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
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
        foreach ($data as $key=>$value) {
            $this->$key = $value;
            /*
            //echo $key;
            if (is_object($value)) {
                //echo ' merged ';
                $data[$key] = $this->em->merge($value);
            }
            if (is_array($value)) { 
                $this->setData($value);
            } else {
                //echo ' set ';
                $this->$key = $value;
            }
             * 
             */
        }
    }
    public function getData() {
        return array(
            'name' => $this->getName(),
            'type' => $this->getType(),
            'teams' => $this->getTeams(),
            'params' => $this->getParams(),
        );
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    public function getName() {
        return $this->name;
    }
    public function setLeague(League $league) {
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
    public function setParams($params) {
        $this->params = $params;
        return $this;
    }
    public function getParams() {
        return $this->params;
    }
}

?>