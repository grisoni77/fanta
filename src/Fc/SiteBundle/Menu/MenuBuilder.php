<?php

namespace Fc\SiteBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Description of MenuBuilder
 *
 * @author 71537
 */
class MenuBuilder extends ContainerAware
{
    
    /**
     * @param Request $request
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'id'    => 'nav-ipsum',
            'class' => 'menu'
        ));
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $this->container->get('request');
        $menu->setCurrentUri($request->getRequestUri());

        $menu->addChild('home', array('route' => 'fc_site_default_index'))->setLabel("Home");
        $menu->addChild('private', array('route' => 'sonata_admin_dashboard'))->setLabel("Private");
        $menu
            ->addChild('leghe', array('route' => 'fc_site_league_index'))->setLabel("Leghe")
                ->addChild('lega', array(
                    'route' => 'fc_site_league_panel', 
                    'routeParameters' => array('id' => $request->get('id', 0))
                ))->setLabel("Lega")
        ;
        $user = $this->container->get('security.context')->getToken()->getUser();
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $menu->addChild('profile', array('route' => 'fos_user_profile_show'))->setLabel("Profile");
            $menu->addChild('logout', array('route' => 'fos_user_security_logout'))->setLabel("Logout");
        } else {
            $menu->addChild('login', array('route' => 'fos_user_security_login'))->setLabel("Login");
        }
        
        return $menu;
    }
}