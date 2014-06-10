<?php

namespace Etpa\Application;

class PersistDomainEventSubscriber implements DomainEventSubscriber
{
    private $eventRepository;

    public function __construct($eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function handleEvent(DomainEvent $event)
    {
        print_r($event);
        die();

        /*
        $databaseEvent = new Event(
            null,
            json_encode($event),
            $event->getType(),

        );
        */

        // $this->eventRepository->persist($event);
    }
}
