<?php

use Doctrine\ORM\EntityManagerInterface;
use DI\ContainerBuilder;
use Nyholm\Psr7\Factory\Psr17Factory;

$builder = new ContainerBuilder();

$builder->addDefinitions([
    EntityManagerInterface::class => function () {
        return (new \Dam\Atelier\Infra\EntityManagerCreator())
            ->getEntityManager();
    },
    Psr\Http\Message\ResponseFactoryInterface::class => function () {
        return new Psr17Factory();
    }
]);

return $builder->build();
