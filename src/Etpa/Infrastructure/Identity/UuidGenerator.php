<?php

namespace Etpa\Infrastructure\Persistence;

use Rhumsaa\Uuid\Uuid;

class UuidGenerator implements \Etpa\UuidGenerator
{
    /**
     * @return string
     */
    public static function generate()
    {
        return Uuid::uuid4();
    }
}
