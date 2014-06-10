<?php

namespace Etpa\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository// implements \Etpa\Domain\EventRepository
{
    /**
     * @param  \Etpa\Domain\Event $event
     */
    public function persist($event)
    {
        $this->_em->persist($event);
    }
}
