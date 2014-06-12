<?php

use Etpa\Domain\Story;
use Etpa\Domain\StoryId;

require_once __DIR__.'/vendor/autoload.php';

$client = new \Predis\Client();
$client->flushAll();

$repository = new \Etpa\Infrastructure\Persistence\Redis\RedisStoryRepository();
$story = new Story(
    new StoryId(),
    'Hexagonal Architecture',
    'Transactional scripts are fearing the world, would you be able to save it?'
);
$repository->persist($story);

$story = new Story(
    new StoryId(),
    'CQRS + ES',
    'Would you be able to escape from the horror event store and all those events?'
);
$repository->persist($story);
