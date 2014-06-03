<?php

namespace Etpa\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Etpa\Domain\Story;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $story = new Story('Story #1', 'Description');
        $manager->persist($story);
        $manager->flush();
    }
}
