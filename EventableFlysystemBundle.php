<?php

namespace FrostieDE\EventableFlysystemBundle;

use FrostieDE\EventableFlysystemBundle\DependencyInjection\Compiler\ReplaceFilesystemsCompilerPass;
use FrostieDE\EventableFlysystemBundle\DependencyInjection\EventableFlysystemExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EventableFlysystemBundle extends Bundle {
    public function build(ContainerBuilder $container) {
        parent::build($container);

        $container->addCompilerPass(new ReplaceFilesystemsCompilerPass());
    }

    public function getContainerExtension() {
        return new EventableFlysystemExtension();
    }
}