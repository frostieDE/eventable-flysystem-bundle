<?php

namespace FrostieDE\EventableFlysystemBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class EventableFlysystemExtension extends Extension {
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $eventDisptacherId = $config['event_dispatcher'];

        foreach($config['filesystems'] as $filesystemId) {
            $this->replaceFilesystem($filesystemId, $container, $eventDisptacherId);
        }
    }

    public function replaceFilesystem($filesystemId, ContainerBuilder $container, $eventDisptacherId) {
        if($container->has($filesystemId)) {
            $originalDefinition = $container->getDefinition($filesystemId);

            $newDefinition = $container
                ->setDefinition($filesystemId, new ChildDefinition('oneup_flysystem.filesystem'))
                ->replaceArgument(0, new Reference($eventDisptacherId))
                ->replaceArgument(1, $originalDefinition->getArgument(0))
                ->replaceArgument(2, $originalDefinition->getArgument(1));

            // Method calls
            $methodCalls = $originalDefinition->getMethodCalls();
            foreach($methodCalls as $methodCall) {
                $newDefinition->addMethodCall($methodCall[0], $methodCall[1]);
            }
        }
    }

    public function getAlias() {
        return 'eventable_flysystem';
    }
}