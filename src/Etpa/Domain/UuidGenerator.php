<?php

namespace Etpa\Domain\Identity;

interface UuidGenerator
{
    /**
     * @return string
     */
    public static function generate();
}
