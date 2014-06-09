<?php

namespace Etpa\Application\Identity;

interface UuidGenerator
{
    /**
     * @return string
     */
    public static function generate();
}
