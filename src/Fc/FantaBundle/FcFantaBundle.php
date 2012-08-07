<?php

namespace Fc\FantaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Fc\FantaBundle\Competition\CompetitionCompilerPass;

class FcFantaBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CompetitionCompilerPass());
    }
}
