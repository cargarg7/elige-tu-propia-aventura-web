<?php

namespace Etpa\Application;

class DomainEventPublisher
{
    private static $instance = null;

    /**
     * @var array
     */
    private $subscribers;

    private function __construct()
    {
        $this->subscribers = array();
    }

    /**
     * @return DomainEventPublisher
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new DomainEventPublisher();
        }

        return static::$instance;
    }

    /**
     * @return $this
     */
    public function publish(DomainEvent $event)
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->handleEvent($event);
        }

        return $this;
    }

    /**
     * @param $events
     * @return $this
     */
    public function publishAll($events)
    {
        foreach ($events as $event) {
            $this->publish($event);
        }

        return $this;
    }

    public function subscribe(DomainEventSubscriber $aSubscriber) {
        $this->subscribers[] = $aSubscriber;
    }

    public function reset() {
        $this->subscribers = array();
    }
}
