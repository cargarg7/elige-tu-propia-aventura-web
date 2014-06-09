<?php

namespace Etpa\Test\Domain;

use Etpa\Domain\Story;
use Etpa\Domain\StoryStatus;

class StoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function newStoryShouldBeInDraft()
    {
        $this->assertSame(StoryStatus::DRAFT, $this->createEmptyStory()->getStatus());
    }

    /**
     * @return Story
     */
    private function createEmptyStory()
    {
        return new Story('title', 'description');
    }
}
