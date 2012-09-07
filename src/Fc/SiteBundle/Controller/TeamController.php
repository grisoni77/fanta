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

use Doctrine\ORM\Query\Expr\Join;

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
    
    /**
     * Displays a form to create a new League Team entity.
     *
     * @Route("/league/team/{id}/edit")
     * @Template()
     */
    public function editAction(Team $team)
    {
        //$em = $this->getDoctrine()->getEntityManager();
        //$league = $em->getRepository('FcFantaBundle:League')->find($league_id);
        //$entity->setLeague($league);
        $form   = $this->createForm(new TeamType(), $team);

        return array(
            'team' => $team,
            'league' => $team->getLeague(),
            'edit_form'   => $form->createView(),
        );
    }    
    
    /**
     * Creates a new League Team entity.
     *
     * @Route("/league/team/{id}/save")
     * @Method("post")
     * @Template("FcSiteBundle:Team:edit.html.twig")
     */
    public function saveAction(Request $request, Team $team)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $form    = $this->createForm(new TeamType(), $team);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();

            return $this->redirect($this->generateUrl('fc_site_league_panel', array('id' => $team->getLeague()->getId())));
        }

        return array(
            'team' => $team,
            'league' => $team->getLeague(),
            'edit_form'   => $form->createView(),
        );
    }    
    
    
    /**
     * Displays a form to create a new market operation
     *
     * @Route("/league/team/{id}/market")
     * @Template()
     */
    public function marketAction(Team $team)
    {
        // getting querybuilder for players
        $em = $this->getDoctrine()->getEntityManager();
        $er = $em->getRepository('FcFantaBundle:Player');
        $qb = $er->createQueryBuilder('p')
                ->select('p')
                //->select('SUM(l.enabled)')
                ->innerJoin('p.currentClub', 'club', Join::WITH, 'club.championship = :champ')
                //->where('club.championship = :champ')
                ->setParameter('champ', $team->getLeague()->getChampionship())
                
                ->leftJoin('p.listings', 'l')
                ->leftJoin('l.team', 't', Join::WITH, 't.league = :league')
                ->setParameter('league', $team->getLeague())
                
                //->where('l.id IS NULL')
                ->groupBy('p.id')
                //->having('SUM(l.enabled) = \'NULL\' ')
                //->orHaving('SUM(l.enabled) = :null')
                //->setParameter('null', null)
                ->orderBy('p.role, p.name')
        ;
                
        // form builder
        $builder = $this->container->get('form.factory')->createBuilder();
        $builder
                ->add('player', 'entity', array(
                    'label' => 'Giocatore', 'class'=>'FcFantaBundle:Player',
                    'property' => 'name',
                    'group_by' => 'role.name',
                    'query_builder' => $qb,
                ))
                ->add('value', 'integer', array('label'=>'Quotazione'))
                ->add('description', 'textarea', array('label'=>'Descrizione', 'required' => false))
                ->add('team', 'hidden', array('data'=>$team->getId()))
                ->add('name', 'hidden', array('data'=>'Acquisto giocatore'))
                // TODO cercare giornata corrente
                ->add('day', 'hidden', array('data'=>1))
        ;
        $form   = $builder->getForm();

        return array(
            'team' => $team,
            'listings' => $team->getListings(),
            'league' => $team->getLeague(),
            'buy_form'   => $form->createView(),
        );
    } 
    
    /**
     * azione per comprare giocatore
     *
     * @Route("/league/team/{id}/buyPlayer")
     * @Template()
     * @Method({"POST"})
     */
    public function buyPlayerAction(Request $request, Team $team)
    {
        $data = $request->request->get('form');
        $builder = new \Fc\FantaBundle\Market\OperationBuilder();
        $builder->setEntityManager($this->getDoctrine()->getEntityManager());
        if ($builder->buyPlayer($data)) {
            return $this->redirect($this->generateUrl('fc_site_team_market', array('id' => $team->getId())));
        } else {
            die('error');
        }
    }    
    
    /**
     * Displays team listings
     *
     * @Route("/league/team/{id}/listing")
     * @Template()
     */
    public function listingAction(Team $team)
    {
        return array(
            'team' => $team,
            'listings' => $team->getListings(),
            'league' => $team->getLeague(),
        );
    }
}