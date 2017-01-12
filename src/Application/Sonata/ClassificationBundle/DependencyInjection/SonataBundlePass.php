<?php

namespace Application\Sonata\ClassificationBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SonataBundlePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('sonata.classification.admin.collection')) {

            $collectionAdmin = $container->getDefinition('sonata.classification.admin.collection');

//            var_dump($collectionAdmin->getTags());


            $collectionAdmin->clearTag("sonata.admin");

            $collectionAdmin->addTag("sonata.admin", array(
                "show_in_dashboard" => false
            ));

//            var_dump($collectionAdmin->getTags());

        }
    }
}