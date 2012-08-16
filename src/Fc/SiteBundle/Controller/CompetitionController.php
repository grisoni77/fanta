<?php

namespace Fc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Description of CompetitionController
 *
 * @author 71537
 */
class CompetitionController extends Controller {

    /**
     * @Route("/league/{id}/competition/wizard/1")
     * @Template()
     */
    public function wizard1Action($id) 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $league = $em->getRepository('FcFantaBundle:League')->find($id);
        
        $competitions = $this->container->getParameter('fc_fanta.competition_types');
        
        return array(
            'league'    => $league,
            'types' => $competitions
        );
    }

    /**
     * @Route("/league/{id}/competition/wizard/2")
     * @Template()
     * @Method({"POST"})
     */
    public function wizard2Action(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $league = $em->getRepository('FcFantaBundle:League')->find($id);
        
        $factory = $this->get('fc_fanta.competition_factory');
        $factory->setCompetitions($this->container->getParameter('fc_fanta.competition_types'));
        $builder = $factory->getCompetitionBuilder($request->request->get('type'));
        
        //create form
        $form = $builder->createForm();
        /*
        $description = $this->render('FcFantaBundle:Competition:championship.html.twig', array(
            'name' => $builder->getLabel()
        ));
        */
        
        return array(
            'league'    => $league,
            'builder'   => $builder,
            'form'      => $form->createView(),
            //'description' => $description->getContent()
            'description_tmpl' => $builder->getDescriptionTemplate()
        );
    }

    /**
     * @Route("/league/{id}/competition/wizard/3")
     * 
     * @Method({"POST"})
     */
    public function wizard3Action(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $league = $em->getRepository('FcFantaBundle:League')->find($id);
        
        $factory = $this->get('fc_fanta.competition_factory');
        $factory->setCompetitions($this->container->getParameter('fc_fanta.competition_types'));
        $builder = $factory->getCompetitionBuilder($request->request->get('type'));
        
        //create form
        $form = $builder->createForm();
        $form->bind($request);
        
        if ($form->isValid()) 
        {
            $data = $form->getData();
            $calendar = $builder->generateDays($data['num_teams']);
            return $this->render('FcSiteBundle:Competition:wizard3.html.twig',
                array(
                    'league'    => $league,
                    'builder'   => $builder,
                    'form'      => $form->createView(),
                    'data'      => $data,
                    'calendar'  => $calendar,
                    //'description' => $description->getContent()
                    'calendar_tmpl' => $builder->getCalendarTemplate(),
                    'description_tmpl' => $builder->getConcreteDescriptionTemplate()
                )
            );
        }
        
        return $this->render('FcSiteBundle:Competition:wizard2.html.twig', array(
            'league'    => $league,
            'builder'   => $builder,
            'form'      => $form->createView(),
            //'description' => $description->getContent()
            'description_tmpl' => $builder->getDescriptionTemplate()
        ));
    }

    
    /**
     * @Route("/league/{id}/competition/wizard/4")
     * 
     * @Method({"POST"})
     */
    public function wizard4Action(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $league = $em->getRepository('FcFantaBundle:League')->find($id);
        
        $factory = $this->get('fc_fanta.competition_factory');
        $factory->setCompetitions($this->container->getParameter('fc_fanta.competition_types'));
        $builder = $factory->getCompetitionBuilder($request->request->get('type'));
        
        //create form
        $form = $builder->createForm();
        $form->bind($request);
        
        $calendar = $builder->generateDays($data['num_teams']);
        
        if ($form->isValid()) 
        {
            $data = $form->getData();
            $builder->createCompetition($data);
            
            $calendar = $builder->generateDays($data['num_teams']);
            return $this->render('FcSiteBundle:Competition:wizard4.html.twig',
                array(
                    'league'    => $league,
                    'builder'   => $builder,
                    'form'      => $form->createView(),
                    'data'      => $data,
                    'calendar'  => $calendar,
                    //'description' => $description->getContent()
                    'calendar_tmpl' => $builder->getCalendarTemplate(),
                    'description_tmpl' => $builder->getConcreteDescriptionTemplate()
                )
            );
        }
        
        return $this->render('FcSiteBundle:Competition:wizard3.html.twig', array(
            'league'    => $league,
            'builder'   => $builder,
            'form'      => $form->createView(),
            //'description' => $description->getContent()
            'description_tmpl' => $builder->getDescriptionTemplate()
        ));
    }
    
    
    
    /**
     * @Route("/league/{id}/competition/wizard/{step}")
     * @Template()
     */
    public function wizardAction(Request $request, $id, $step = 'step1') 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $league = $em->getRepository('FcFantaBundle:League')->find($id);

        $report = new \Fc\SiteBundle\Wizard\CompetitionReport();
        $report->setLeague($league);        
        $data = $this->container->get('session')->get('competitionReportData');
        if ($data) {
            $report->setData($data);
        }
        $wizard = new \Fc\SiteBundle\Wizard\CompetitionWizard(
                $report,
                $this->get('fc_fanta.competition_factory')
        );
        $step = $wizard->get($step);
        /*
        $form = $this->createForm($step->getFormType(), $wizard->getReport(), array(
            'validation_groups' => array($step->getName()),
            'flowStep' => $step->getName(),
            'league' => $league,
        ));
         */
        $form = $step->getForm($wizard->getReport(), array(
            'validation_groups' => array($step->getName()),
        ));
        
        if ($request->getMethod() === 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $wizard->process($step);

                // You should proberly save some stuff here? 
                $this->container->get('session')->set('competitionReportData', $report->getData());
                
                
                // And redirect
                if ($wizard->last() === $step) {
                    // elimina info in sessione
                    $this->container->get('session')->set('competitionReportData', null);
                    // redirect
                    return $this->redirect($this->generateUrl('fc_site_league_panel', array('id'=>$league->getId()))); // redirect when done
                } else {
                    return $this->redirect($this->generateUrl('fc_site_competition_wizard', array(
                        'id'    =>  $league->getId(), 
                        'step'  =>  $wizard->getNextStepByStep($step)->getName(),
                    ))); // redirect when done
                }
            }
        }

        $next = $wizard->getNextStepByStep($step);
        return array(
            'league'    => $league,
            'step'      => $step,
            'isNextStepVisible'   => ($next ? $next->isVisible($report) : false),
            'nextStep'  => $next,
            'prevStep'  => $wizard->getPreviousStepByStep($step),
            'form' => $form->createView(),
        );
    }    
}