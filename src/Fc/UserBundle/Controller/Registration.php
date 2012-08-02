<?php

namespace Fc\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of Registration
 *
 * @author 71537
 */
class Registration extends Controller {

    public function indexAction() {
        return new Response('Hello world!');
    }

}

?>