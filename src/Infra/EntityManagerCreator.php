<?php

namespace Dam\Atelier\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator
{
    public static function getEntityManager(): EntityManager
    {
        $isDevMode = true;
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__."/.."],
            $isDevMode
        );

        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite',
        ];

        return EntityManager::create($conn, $config);
    }
}
