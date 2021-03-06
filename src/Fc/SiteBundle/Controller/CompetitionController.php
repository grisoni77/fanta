<?php

namespace Fc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Fc\FantaBundle\Entity\League;
use Fc\FantaBundle\Entity\Competition;

/**
 * Description of CompetitionController
 *
 * @author 71537
 */
class CompetitionController extends Controller 
{
    /**
     * @Route("/league/{id}/competition/wizard/{step}")
     * @Template()
     */
    public function wizardAction(Request $request, League $league, $step = 'step1') 
    {
        $em = $this->getDoctrine()->getEntityManager();
        //$league = $em->getRepository('FcFantaBundle:League')->find($id);
        
        // check championship is ready
        if (!$league->getChampionship()->isEnabled() || !$league->getChampionship()->isCalendarFrozen()) {
            throw new \Exception('Questo campionato non è ancora stato consolidato');
        }
        // get report( will contains data in session )
        $report = new \Fc\SiteBundle\Wizard\CompetitionReport($em);
        // default data (almeno la lega)
        $report->setData(array('league'=>$league));
        // get data from session
        $data = $this->container->get('session')->get('competitionReportData');
        if ($data) {
            // set report data
            $report->setData($data);
        }
        // build wizard
        $wizard = new \Fc\SiteBundle\Wizard\CompetitionWizard(
                $report,
                $this->get('fc_fanta.competition_factory')
        );
        // get step object
        $step = $wizard->get($step);
        // get step form
        $form = $step->getForm($report);
        // process steps (basically set visible prop for tmpl rendering)
        $wizard->process($step);
        
        if ($request->getMethod() === 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                // process again (after form data have been submitted)
                $wizard->process($step);

                // save data in session
                $this->container->get('session')->set('competitionReportData', $report->getData());
                
                // And redirect
                if ($wizard->last() === $step) {
                    // qui chiama la generazione della competizione..
                    // @TODO
                    $comp = $this->get('fc_fanta.competition_factory')->getCompetitionBuilder($report->getType());
                    $comp->createCompetition($report);
                    // elimina info in sessione
                    $this->container->get('session')->set('competitionReportData', null);
                    // redirect
                    return $this->redirect($this->generateUrl('fc_site_league_panel', array('id'=>$league->getId()))); // redirect when done
                } else {
                    // passa allo step successivo
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
            'wizard'    => $wizard,
            'step'      => $step,
            'step_tmpl' => $step->getDescriptionTemplate($report),
            'isNextStepVisible'   => ($next ? $next->isVisible($report) : false),
            'nextStep'  => $next,
            'prevStep'  => $wizard->getPreviousStepByStep($step),
            'form' => $form->createView(),
        );
    }    
    
    
    /**
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param int $lid
     * @param int $cid
     * 
     * @Route("league/{lid}/competition/{id}/calendar")
     * @ParamConverter("league",      class="FcFantaBundle:League",      options={"id"="lid"})
     * @Template()
     */
    public function calendarAction(Request $request, League $league, Competition $competition)
    {
        $decorated = $this->container->get('fc_fanta.competition_factory')->getDecoratedCompetition($competition);
        
        return array(
            'competition'   => $decorated,
            'league'        => $decorated->getLeague(),
            'calendar'      => $decorated->getCalendar(),
            'calendar_tmpl' => $decorated->getCalendarTemplate()
        );
    }
}