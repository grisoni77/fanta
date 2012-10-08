<?php

namespace Fc\FantaBundle\Tests\Entity;

use Fc\FantaBundle\Entity\Championship;

/**
 * Description of ChampionshipTest
 *
 * @author 71537
 */
class ChampionshipTest extends \PHPUnit_Framework_TestCase
{
    public function testSetName()
    {
        $champ = new Championship();
        $champ->setName('Pippo');
        $this->assertEquals($champ->getName(), 'Pippo');
    }
    
}

?>