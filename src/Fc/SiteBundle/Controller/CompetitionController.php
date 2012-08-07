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
     * @Route("/league/{id}/competition/wizard")
     * @Template()
     */
    public function wizardAction($id) 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $league = $em->getRepository('FcFantaBundle:Competition')->find($id);
        
        $factory = $this->get('fc_fanta.competition_factory');
        $competitions = $factory->getCompetitionTypes();
        
        return array(
            'league'    => $league,
            'types' => $competitions
        );
    }

}