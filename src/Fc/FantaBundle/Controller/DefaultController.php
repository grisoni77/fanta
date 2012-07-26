<?php

namespace Fc\FantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;

use Fc\FantaBundle\Entity\Player;
use Fc\FantaBundle\Entity\Team;
use Fc\FantaBundle\Entity\Signing;

class DefaultController extends Controller
{
    /**
     * @Route("/") 
     * @Template
     */
    public function indexAction() 
    {
        return array();
    }
    
    /**
     * @Route("/fanta/add/{name}")
     * @Template()
     */
    public function addAction($name)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $player = new Player();
        $player->setName($name);
        $team = $this->getDoctrine()->getRepository('FcFantaBundle:Team')->find(1);
        if (!$team) {
            throw $this->createNotFoundException('Nessun prodotto trovato per l\'id 1');
        }
        $signing = new Signing();
        $signing->setDay(1);
        $signing->setPlayer($player);
        $signing->setTeam($team);
        
        $em->persist($player);
        $em->persist($signing);
        $em->flush();
        
        return array('name' => $name);
    }
    
    /**
     * @Route("/fanta/team/{id}/rosa")
     * @Template
     */
    public function getPlayersAction($id)
    {
        $team = $this->getDoctrine()->getRepository('FcFantaBundle:Team')->find(1);
        if (!$team) {
            throw $this->createNotFoundException('Nessun prodotto trovato per l\'id 1');
        }
        
        $players = $team->getPlayers();
        /*
        foreach ($players as $p) {
            print_r($p->getName());
            
        }
         * 
         */
        return array('players' => $players);
    }
    
}
