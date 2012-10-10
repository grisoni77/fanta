<?php

namespace Fc\FantaBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Fc\FantaBundle\Entity\Season;
use Fc\FantaBundle\Entity\Championship;
/**
 * Description of ChampionshipTest
 *
 * @author 71537
 */
class ChampionshipTest extends WebTestCase
{
    private $em;
    
    private $season; 
    
    public function setUp() 
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
        // set season
        $this->season = new Season();
        $this->season->setTitle('Stagione 2012');
        $this->season->setEnabled(true);
        $this->em->persist($this->season);
    }
    
    public function testSetName()
    {
        $champ = new Championship();
        $champ->setName('Pippo');
        $this->assertEquals($champ->getName(), 'Pippo');
    }
    
    public function testSetSeason()
    {
        $champ = new Championship();
        $champ->setName('Pippo');
        $champ->setSeason($this->season);
        $this->assertEquals($champ->getSeason()->getTitle(), $this->season->getTitle());
    }
    
    public function testAddChampionship()
    {
        $champ = new Championship();
        $champ->setName('Pippo');
        $this->season->addChampionship($champ);
        $champ->setSeason($this->season);
        // Add
        $this->assertTrue($champ->getSeason() instanceof Season);
        $champs = $this->season->getChampionships();
        $this->assertTrue($champs->first() instanceof Championship);
        // Remove
        $this->season->removeChampionship($champ);
        $champ->setSeason(null);
        $champs = $this->season->getChampionships();
        $this->assertEquals(count($champs), 0);
        $this->assertEquals($champ->getSeason(), null);
        
    }
    
}

?>