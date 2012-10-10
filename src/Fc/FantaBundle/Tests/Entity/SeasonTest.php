<?php

namespace Fc\FantaBundle\Tests\Entity;

use Fc\FantaBundle\Entity\Season;

/**
 * Description of ChampionshipTest
 *
 * @author 71537
 */
class SeasonTest extends \PHPUnit_Framework_TestCase
{
    public function testSetTitle()
    {
        $season = new Season();
        $season->setTitle('Serie A');
        $this->assertEquals($season->getTitle(), 'Serie A');
        
        $this->assertEquals((string) $season, 'Serie A');
    }
    
}

?>