<?php

namespace Etpa\Application;

use Etpa\Domain\Event;

class PersistDomainEventSubscriber implements DomainEventSubscriber
{
    private $eventRepository;

    public function __construct($eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function handleEvent(DomainEvent $event)
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $serializedEvent = $serializer->serialize($event, 'json');

        $databaseEvent = new Event(
            $event->getType(),
            $serializedEvent,
            $event->getStreamName()
        );

        $this->eventRepository->persist($databaseEvent);
    }
}
