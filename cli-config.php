<?php
require_once __DIR__.'/vendor/autoload.php';

use Etpa\Infrastructure\Persistence\Doctrine\EntityManagerFactory;

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(
    (new EntityManagerFactory())->build()
);
