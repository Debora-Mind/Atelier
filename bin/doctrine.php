<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Dam\Atelier\Infra\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = (new Dam\Atelier\Infra\EntityManagerCreator)->getEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
