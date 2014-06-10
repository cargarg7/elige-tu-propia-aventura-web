<?php

namespace Etpa\Application;

interface DomainEventSubscriber
{
    public function handleEvent(DomainEvent $event);
}
