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
use Fc\FantaBundle\Entity\Subscription;
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
        $subscriptions = $user ? $em->getRepository('FcFantaBundle:League')->findSubscriptedLeagues($user) : array();
        // leghe aperte a cui utente non è iscritto
        $openLeagues = $user ? $em->getRepository('FcFantaBundle:League')->findOpenLeagues($user) : array();
        // leghe aperte a cui utente non è iscritto
        $otherLeagues = $user ? $em->getRepository('FcFantaBundle:League')->findOtherLeagues($user) : array();
        
        return array(
            'userLeagues'   => $userLeagues,
            'subscriptions' => $subscriptions,
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
        $subscriptions = $league->getSubscriptions();
        
        return array(
            'league'          => $league,
            'subscriptions'   => $subscriptions
        );        
    }
    
    /**
     *  @Route("/enable/subscription") 
     *  @Method({"POST"})
     */
    public function enableSubscriptionAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $subId = $request->get('subscription_id');
        $sub = $em->getRepository('FcFantaBundle:Subscription')->find($subId);
        $sub->setEnabled(true);
        $em->persist($sub);
        $em->flush();
        return new RedirectResponse($this->generateUrl('fc_site_league_panel', array('id'=>$sub->getLeague()->getId())));
    }
    
    /**
     *  @Route("/disable/subscription") 
     *  @Method({"POST"})
     */
    public function disableSubscriptionAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $subId = $request->get('subscription_id');
        $sub = $em->getRepository('FcFantaBundle:Subscription')->find($subId);
        $sub->setEnabled(false);
        $em->persist($sub);
        $em->flush();
        return new RedirectResponse($this->generateUrl('fc_site_league_panel', array('id'=>$sub->getLeague()->getId())));
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
            //aggiungi iscrizione per l'owner
            $subscription = new Subscription();
            $subscription->setLeague($entity);
            $subscription->setUser($entity->getOwner());
            $subscription->setEnabled(true);
            $em->persist($subscription);
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
        $entity = new Subscription();
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