<?php

namespace Etpa\Infrastructure\Identity\Uuid;

use Rhumsaa\Uuid\Uuid;
use Etpa\Application\Identity\AggregateIdGenerator;

class UuidAggregateIdGenerator implements AggregateIdGenerator
{
    /**
     * @return string
     */
    public static function generate()
    {
        return Uuid::uuid1()->toString();
    }
}
