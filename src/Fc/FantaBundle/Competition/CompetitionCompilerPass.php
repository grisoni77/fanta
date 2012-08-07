<?php

namespace Fc\FantaBundle\Competition;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;


/**
 * Description of CompetitionCompilerPass
 *
 * @author 71537
 */
class CompetitionCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('fc_fanta.competition_factory')) {
            return;
        }

        $definition = $container->getDefinition('fc_fanta.competition_factory');

        foreach ($container->findTaggedServiceIds('fc_fanta.competition') as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall('addCompetition', array(new Reference($id), $attributes["label"]));
            }
        }
    }
}