<?php

namespace Fc\FantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Fc\FantaBundle\Entity\Player as Player;
use Fc\FantaBundle\Entity\Club as Club;
use Fc\FantaBundle\Entity\Championship as Championship;

/**
 * Fc\FantaBundle\Controller\PlayerController
 *
 * @author cris
 * @Route("/player")
 */
class PlayerController extends Controller {

    /**
     * @Route("/add/{name}/{clubName}")
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse 
     */
    public function addPlayerAction($name, $clubName) {
        $em = $this->getDoctrine()->getEntityManager();
        
        $player = new Player();
        $player->setName($name);
        $player->setCode(rand());
        
        $role = $em->getRepository('FcFantaBundle:Role')->findOneBy(array('name' => 'Difensore'));
        $player->setRole($role);
        
        $club = $em->getRepository('FcFantaBundle:Club')->findOneBy(array('name' => $clubName));
        print_r($club->getName());
        if (!$club) { // la crea se non esiste
            $club = new Club();
            $club->setName($clubName);
            $cham = $em->getRepository('FcFantaBundle:Championship')->find(1); // la prima tanto per..
            $club->setChampionship($cham);
            //$em->persist($club);
        }
        
        $club->addPlayer($player);
        //$player->addClub($club);
        
        $em->persist($club);
        $em->persist($player);
        $em->flush();
        
        return new RedirectResponse($this->get('router')->generate('season'));
    }

}

?>