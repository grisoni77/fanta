<?php

namespace Fc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of LeagueController
 *
 * @author 71537
 * @Route("/league")
 */
class LeagueController extends Controller 
{
    /**
     * @Route("/league/index")
     * @Template("FcSiteBundle:League:index.html.twig")
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        $userLeagues = $user ? $em->getRepository('FcFantaBundle:League')->findUserLeagues($user) : array();
        
        return array('userLeagues'=>$userLeagues);
    }

}