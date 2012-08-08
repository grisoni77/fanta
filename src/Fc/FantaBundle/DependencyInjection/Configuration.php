<?php

namespace Fc\FantaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fc_fanta');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->arrayNode('competitions')
                ->addDefaultChildrenIfNoneSet()
                ->prototype('array')
                    ->children()
                        ->scalarNode('name')->defaultValue('championship')->end()
                        ->scalarNode('label')->defaultValue('Campionato a gironi')->end()
                        ->scalarNode('class')->defaultValue('\Fc\FantaBundle\Competition\ChampionshipCompetition')->end()
                    ->end()
                ->end()
                /*
                ->defaultValue(array(
                    'name' => 'championship',
                    'label' => 'Campionato a gironi',
                    'class' => '\Fc\FantaBundle\Competition\ChampionshipCompetition',
                ))->end()
                 * 
                 */
            ->end()
        ;
        
        return $treeBuilder;
    }
}
