<?php

namespace Fc\AdminBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of SeasonAdminController
 *
 * @author cris
 */
class ChampionshipAdminController extends Controller {

    /**
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function importAction()
    {
        //return new Response("<p>test import</p>");
        return array();
    }
}
