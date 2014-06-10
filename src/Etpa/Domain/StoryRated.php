<?php

namespace Etpa\Domain;

use Etpa\Application\DomainEvent;

class StoryRated implements DomainEvent
{
    private $storyId;
    private $eventVersion;
    private $occurredOn;
    private $rating;

    public function __construct($storyId, $rating)
    {
        $this->storyId = $storyId;
        $this->rating = $rating;
        $this->eventVersion = 1;
        $this->occurredOn = new \DateTime();
    }

    public function getType()
    {
        return __CLASS__;
    }

    public function getStreamName()
    {
        return 'story-rated:'.$this->storyId;
    }

    /**
     * @return int
     */
    public function eventVersion()
    {
        return $this->eventVersion;
    }

    /**
     * @return \DateTime
     */
    public function occurredOn()
    {
        return $this->occurredOn;
    }
}
