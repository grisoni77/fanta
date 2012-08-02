<?php

namespace Fc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template("FcSiteBundle:Default:home.html.twig")
     */
    public function indexAction(Request $request)
    {
        $layout = $request->get('layout', 'layout2col');
        return array('name' => 'nome', 'extends' => '::'.$layout.'.html.twig');
    }
}
