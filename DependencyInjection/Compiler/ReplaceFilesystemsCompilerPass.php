<?php

namespace FrostieDE\EventableFlysystemBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class ReplaceFilesystemsCompilerPass implements CompilerPassInterface {
    public function process(ContainerBuilder $container) {
        $filesystemIds = $container->getParameter('eventable_flysystem.filesystems');
        $eventDispatcherId = $container->getParameter('eventable_flysystem.event_dispatcher');

        foreach($filesystemIds as $filesystemId) {
            if($container->has($filesystemId)) {
                $originalDefinition = $container->getDefinition($filesystemId);

                $tag = $originalDefinition->getTag('oneup_flysystem.filesystem');

                $container
                    ->setDefinition($filesystemId, new Definition(EventableFilesystem::class))
                    ->setArgument(0, new Reference($eventDispatcherId))
                    ->setArgument(1, $originalDefinition->getArgument(0))
                    ->setArgument(2, $originalDefinition->getArgument(1))
                    ->addTag('oneup_flysystem.filesystem', $tag);

                $newDefinition = $container->getDefinition($filesystemId);

                // Method calls
                $methodCalls = $originalDefinition->getMethodCalls();
                foreach($methodCalls as $methodCall) {
                    $newDefinition->addMethodCall($methodCall[0], $methodCall[1]);
                }
            }
        }
    }
}