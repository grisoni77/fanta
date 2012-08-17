<?php

namespace Fc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Fc\FantaBundle\Entity\League;
use Fc\SiteBundle\Form\Type\LeagueType;
use Fc\FantaBundle\Entity\Team;
use Fc\SiteBundle\Form\Type\SubscriptionType;

/**
 * Description of LeagueController
 *
 * @author 71537
 * @Route("/league")
 */
class LeagueController extends Controller 
{
    /**
     * @Route("/index")
     * @Template("FcSiteBundle:League:index.html.twig")
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        // leghe create dall'utente
        $userLeagues = $user ? $em->getRepository('FcFantaBundle:League')->findUserLeagues($user) : array();
        // leghe a cui è iscritto l'utente
        $teams = $user ? $em->getRepository('FcFantaBundle:League')->findUserTeams($user) : array();
        // leghe aperte a cui utente non è iscritto
        $openLeagues = $user ? $em->getRepository('FcFantaBundle:League')->findOpenLeagues($user) : array();
        // leghe aperte a cui utente non è iscritto
        $otherLeagues = $user ? $em->getRepository('FcFantaBundle:League')->findOtherLeagues($user) : array();
        
        return array(
            'userLeagues'   => $userLeagues,
            'teams' => $teams,
            'openLeagues' => $openLeagues,
            'otherLeagues' => $otherLeagues
        );
    }

    /**
     * @Route("/{id}/panel")
     * @Template("FcSiteBundle:League:panel.html.twig")
     */
    public function panelAction($id) 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        $league = $em->getRepository('FcFantaBundle:League')->find($id);
        // get league teams
        $teams = $league->getTeams();
        // get competitions
        $competitions = $em->getRepository('FcFantaBundle:League')->findLeagueCompetitions($league);
        // get user team
        $team = $em->getRepository('FcFantaBundle:Team')->findOneBy(array('user'=>$user));
        $userTeam = $em->getRepository('FcFantaBundle:Team')->findOneBy(array(
            'user'   => $user,
            'league' => $league,
        ));
        
        return array(
            'league'          => $league,
            'teams'           => $teams,
            'competitions'    => $competitions,
            'userTeam'        => $userTeam
        );        
    }
    
    /**
     *  @Route("/enable/subscription") 
     *  @Method({"POST"})
     */
    public function enableSubscriptionAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $teamId = $request->get('team_id');
        $team = $em->getRepository('FcFantaBundle:Team')->find($teamId);
        $team->setEnabled(true);
        $em->persist($team);
        $em->flush();
        return new RedirectResponse($this->generateUrl('fc_site_league_panel', array('id'=>$team->getLeague()->getId())));
    }
    
    /**
     *  @Route("/disable/subscription") 
     *  @Method({"POST"})
     */
    public function disableSubscriptionAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $teamId = $request->get('team_id');
        $team = $em->getRepository('FcFantaBundle:Team')->find($teamId);
        $team->setEnabled(false);
        $em->persist($team);
        $em->flush();
        return new RedirectResponse($this->generateUrl('fc_site_league_panel', array('id'=>$team->getLeague()->getId())));
    }
    

    /**
     * Displays a form to create a new League entity.
     *
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new League();
        $form   = $this->createForm(new LeagueType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new League entity.
     *
     * @Route("/create")
     * @Method("post")
     * @Template("FcFantaBundle:League:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new League();
        $entity->setOwner($this->getUser());
        $request = $this->getRequest();
        $form    = $this->createForm(new LeagueType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            //aggiungi squadra per l'owner
            $team = new Team();
            $team->setName($entity->getOwner()->getName().'\'s team');
            $team->setLeague($entity);
            $team->setUser($entity->getOwner());
            $team->setEnabled(true);
            $team->setMessage('League Owner');
            $em->persist($team);
            $em->flush();

            return $this->redirect($this->generateUrl('fc_site_league_panel', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
    /**
     * Displays a form to subscribe League entity.
     *
     * @Route("/subscribe/{id}")
     * @Template()
     * @Method({"GET","POST"})
     */
    public function subscribeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $league = $em->getRepository('FcFantaBundle:League')->find($id);
        $entity = new Team();
        $entity->setLeague($league);
        $entity->setUser($this->getUser());
        $form   = $this->createForm(new SubscriptionType(), $entity);

        
        if ($request->getMethod() === 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('fc_site_league_index'));
            }             
        }
        
        
        return array(
            'league' => $league,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
}