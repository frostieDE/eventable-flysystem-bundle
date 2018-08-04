<?php

namespace FrostieDE\EventableFlysystemBundle\DependencyInjection;

use FrostieDE\EventableFlysystem\EventableFilesystem;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class EventableFlysystemExtension extends Extension {
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('eventable_flysystem.filesystems', $config['filesystems']);
        $container->setParameter('eventable_flysystem.event_dispatcher', $config['event_dispatcher']);

        $eventDisptacherId = $config['event_dispatcher'];
    }

    public function getAlias() {
        return 'eventable_flysystem';
    }
}