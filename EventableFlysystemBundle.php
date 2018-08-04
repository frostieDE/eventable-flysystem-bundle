<?php

namespace FrostieDE\EventableFlysystemBundle;

use FrostieDE\EventableFlysystemBundle\DependencyInjection\EventableFlysystemExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EventableFlysystemBundle extends Bundle {
    public function getContainerExtension() {
        return new EventableFlysystemExtension();
    }
}