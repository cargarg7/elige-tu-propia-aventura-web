<?php

require_once __DIR__.'/vendor/autoload.php';

use Etpa\Infrastructure\Persistence\Doctrine\EntityManagerFactory;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

$em = (new EntityManagerFactory())->build();

$loader = new Loader();
$loader->loadFromDirectory(__DIR__.'/src/Etpa/Fixtures');

$purger = new ORMPurger();
$executor = new ORMExecutor($em, $purger);
$executor->execute($loader->getFixtures());
