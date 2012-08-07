<?php

namespace Fc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Fc\FantaBundle\Entity\Team;
use Fc\SiteBundle\Form\Type\TeamType;

/**
 * Description of TeamController
 *
 * @author 71537
 */
class TeamController extends Controller 
{

    /**
     * Displays a form to create a new League Team entity.
     *
     * @Route("/league/{league_id}/user/{user_id}/team/new")
     * @Template()
     */
    public function newAction($league_id, $user_id)
    {
        //$em = $this->getDoctrine()->getEntityManager();
        $entity = new Team();
        //$league = $em->getRepository('FcFantaBundle:League')->find($league_id);
        //$entity->setLeague($league);
        $form   = $this->createForm(new TeamType(), $entity);

        return array(
            'entity' => $entity,
            'league_id' => $league_id,
            'user_id' => $user_id,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new League Team entity.
     *
     * @Route("/league/{league_id}/user/{user_id}/team/create")
     * @Method("post")
     * @Template("FcFantaBundle:Team:new.html.twig")
     */
    public function createAction($league_id, $user_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity  = new Team();
        $league = $em->getRepository('FcFantaBundle:League')->find($league_id);
        $user = $em->getRepository('FcUserBundle:User')->find($user_id);
        $entity->setLeague($league);
        $entity->setUser($user);
        $request = $this->getRequest();
        $form    = $this->createForm(new TeamType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fc_site_league_panel', array('id' => $entity->getLeague()->getId())));
        }

        return array(
            'entity' => $entity,
            'league_id' => $league_id,
            'user_id' => $user_id,
            'form'   => $form->createView(),
        );
    }
}