<?php

namespace Etpa\Infrastructure\Identity;

use Rhumsaa\Uuid\Uuid;
use Etpa\Application\Identity\UuidGenerator as UuidGeneratorInterface;

class UuidGenerator implements UuidGeneratorInterface
{
    /**
     * @return string
     */
    public static function generate()
    {
        return Uuid::uuid1()->toString();
    }
}
