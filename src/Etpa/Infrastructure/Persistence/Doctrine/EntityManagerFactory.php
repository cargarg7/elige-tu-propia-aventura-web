<?php

namespace Etpa\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\Types\Type;

class EntityManagerFactory
{
    public function build()
    {
        $config = Setup::createYAMLMetadataConfiguration([__DIR__.'/config'], true);
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../../../../db.sqlite',
        );

        Type::addType('storyid', 'Etpa\Infrastructure\Persistence\Doctrine\DBAL\Types\StoryIdType');
        $em = EntityManager::create($conn, $config);
        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('storyid', 'storyid');

        return $em;
    }
}
