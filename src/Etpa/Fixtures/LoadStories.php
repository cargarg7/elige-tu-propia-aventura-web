<?php

namespace Etpa\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Etpa\Domain\Story;
use Etpa\Domain\StoryId;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $story = new Story(
            null,
            'Hexagonal Architecture',
            'Transactional scripts are fearing the world, would you be able to save it?'
        );
        $manager->persist($story);

        $story = new Story(
            null,
            'CQRS + ES',
            'Would you be able to escape from the horror event store and all those events?'
        );
        $manager->persist($story);

        $manager->flush();
    }
}
