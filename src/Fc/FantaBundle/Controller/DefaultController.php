<?php

namespace Fc\FantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;

use Fc\FantaBundle\Entity\Player;
use Fc\FantaBundle\Entity\Team;
use Fc\FantaBundle\Entity\Day;
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
     * @Route("/add/{name}/to/{clubname}")
     * @Template()
     */
    public function addAction($name, $clubname)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $player = $this->getDoctrine()->getRepository('FcFantaBundle:Player')->findOneBy(array('name'=>$name));
        if (!$player) {
            $player = new Player();
            $player->setName($name);
            $player->setCode(rand());
            $role = $this->getDoctrine()->getRepository('FcFantaBundle:Role')->findOneBy(array('name'=>'Difensore'));
            if (!$role) {
                throw $this->createNotFoundException('Nessun ruolo trovato per il nome Difensore');
            }
            $player->setRole($role);
            $club = $this->getDoctrine()->getRepository('FcFantaBundle:Club')->findOneBy(array('name'=>$clubname));
            if (!$club) {
                throw $this->createNotFoundException('Nessun club trovato per il nome '.$clubname);
            }
            //$player->addClub($club);
            $em->persist($player);
        }
        
        // set signing
        $day = $em->getRepository('FcFantaBundle:Day')->findOneBy(array(
            'championship' => $club->getChampionship(),
            'number' => 0,
        ));
        $signing = new Signing();
        $signing->setDay($day);
        $signing->setPlayer($player);
        $signing->setClub($club);
        $player->setCurrentClub($club);
        $em->persist($signing);
        /*
        $signing = $em->getRepository('FcFantaBundle:Signing')->findOneBy(array(
            'player'=>$player,
            'club'=>$club,
            'day'=>null
        ));
        $signing->setDay($day);
        $em->persist($signing);
        */
        
        $em->flush();
        
        return array('name' => $name);
    }

    /**
     * @Route("/move/{pid}/to/{cid}/in/{num}")
     * 
     */
    public function moveAction($pid, $cid, $num)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $player = $this->getDoctrine()->getRepository('FcFantaBundle:Player')->find($pid);
        $club = $this->getDoctrine()->getRepository('FcFantaBundle:Club')->find($cid);
        
        // set signing
        $day = $em->getRepository('FcFantaBundle:Day')->findOneBy(array(
            'championship' => $club->getChampionship(),
            'number' => $num,
        ));
        $signing = new Signing();
        $signing->setDay($day);
        $signing->setPlayer($player);
        $signing->setClub($club);
        $player->setCurrentClub($club);
        $em->persist($signing);
        
        $em->flush();
        
        return array('name' => $name);
    }

    
    /**
     * @Route("/team/{id}/rosa")
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
