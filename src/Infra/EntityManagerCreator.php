<?php

namespace Dam\Atelier\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator
{
    /**
     * @throws ORMException
     */
    public static function getEntityManager(): EntityManager
    {
        $isDevMode = true;
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__."/.."],
            $isDevMode
        );

        $conn = [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'port' => '3306',
            'dbname' => 'atelier',
            'user' => 'root',
            'password' => '',
        ];

        return EntityManager::create($conn, $config);

    }
}
