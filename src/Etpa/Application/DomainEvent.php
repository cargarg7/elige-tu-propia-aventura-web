<?php

namespace Etpa\Application;

interface DomainEvent
{
    /**
     * @return int
     */
    public function eventVersion();

    /**
     * @return \DateTime
     */
    public function occurredOn();
}
