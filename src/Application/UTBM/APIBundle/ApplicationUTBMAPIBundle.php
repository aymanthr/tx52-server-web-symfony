<?php

namespace Application\UTBM\APIBundle;

use Application\Sonata\ClassificationBundle\DependencyInjection\SonataBundlePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationUTBMAPIBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SonataBundlePass());
    }

}
