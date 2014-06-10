<?php

namespace Etpa\Domain;

use Etpa\Application\DomainEvent;

class StoryRated implements DomainEvent
{
    private $storyId;
    private $eventVersion;
    private $occurredOn;

    public function __construct($storyId)
    {
        $this->storyId = $storyId;
        $this->eventVersion = 1;
        $this->occurredOn = new \DateTime();
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
