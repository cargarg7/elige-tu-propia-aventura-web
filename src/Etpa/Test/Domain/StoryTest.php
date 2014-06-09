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
     * @test
     */
    public function newStoryShouldHaveNoRating()
    {
        $this->assertNull($this->createEmptyStory()->getRating());
    }

    /**
     * @test
     */
    public function addSomeRatingsToNewStoryShouldProperlyRatingCalculated()
    {
        $this->assertSame(
            3.0,
            $this->createEmptyStory()
                ->rate(3)
                ->getRating()
        );

        $this->assertSame(
            3.0,
            $this->createEmptyStory()
                ->rate(3)
                ->rate(3)
                ->getRating()
        );

        $this->assertSame(
            3.0,
            $this->createEmptyStory()
                ->rate(1)
                ->rate(2)
                ->rate(3)
                ->rate(4)
                ->rate(5)
                ->getRating()
        );
    }


    /**
     * @return Story
     */
    private function createEmptyStory()
    {
        return new Story(null, 'title', 'description');
    }
}
