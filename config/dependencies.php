<?php

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    \Doctrine\ORM\EntityManagerInterface::class => function () {
        return (new \Dam\Atelier\Infra\EntityManagerCreator())
            ->getEntityManager();
    }
]);
$container = $builder->build();

return $container;
