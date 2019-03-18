<?php

namespace App\DependencyInjection\Compiler;

use App\Component\Router;
use App\Component\UrlGenerator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class UrlGeneratorPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $container->setParameter('router.options.generator_class', UrlGenerator::class);
        $container->setParameter('router.options.generator_base_class', UrlGenerator::class);
    }
}