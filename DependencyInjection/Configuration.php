<?php

namespace FrostieDE\EventableFlysystemBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('eventable_flysystem');

        $rootNode
            ->children()
                ->arrayNode('filesystems')
                    ->scalarPrototype()->end()
                ->end()
                ->scalarNode('event_dispatcher')
                    ->defaultValue('event_dispatcher')
                ->end()
            ->end();

        return $treeBuilder;
    }
}