<?php

namespace App\Component;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router as BaseRouter;
use Symfony\Component\Routing\RequestContext;

class Router extends BaseRouter
{
    private $defaultLocale;

    public function __construct(ContainerInterface $container, $resource, array $options = [], RequestContext $context = null, ContainerInterface $parameters = null, LoggerInterface $logger = null)
    {
        $options['generator_class'] = UrlGenerator::class;
        $options['generator_base_class'] = UrlGenerator::class;

        parent::__construct($container, $resource, $options, $context, $parameters, $logger);
    }

    public function getGenerator()
    {
        $generator =  parent::getGenerator();

        if($generator instanceof UrlGenerator){

            $generator->setDefaultLocale($this->defaultLocale);
        }

        return $generator;
    }

    public function setDefaultLocale($defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;
    }
}