<?php

namespace Fc\SiteBundle\Handler;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\SecurityContext;

class SessionIdleHandler
{
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * @var array
     */
    protected $options;

    /**
     * Class constructor
     *
     * @param   RouterInterface $router
     * @param   SecurityContext $context
     * @param   array           $options
     */
    public function __construct(RouterInterface $router, SecurityContext $context, $options = array())
    {
        $this->router          = $router;
        $this->securityContext = $context;
        $this->options         = $options;
    }

    /**
     * Handles kernel request events
     *
     * @param   GetResponseEvent    $event
     * @return  void
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        // per pagine non firewallate non esiste security context
        // @TODO abilitare firewall anonimo su pagine come questa (profiler, ecc..)
        if ($this->securityContext->getToken() === null) {
            return;
        } elseif (!$this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            return;
        }
        
        // Get session
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $event->getRequest()->getSession();

        $maxIdleTime = $this->options['idleTime'] * 60;
        if (time() - $session->getMetadataBag()->getLastUsed() > $maxIdleTime) {
            $session->invalidate();
            $this->securityContext->setToken(null);
            // Set flash message
            $session->setFlash('notice', 'You have been automatically logged out.');
            // Generate redirect response and set as new response
            // on the original event
            $url = $this->router->generate($this->options['redirectRoute']);
            $response = new RedirectResponse($url);
            $event->setResponse($response);
        }
    }
}