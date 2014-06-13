<?php

namespace Etpa\Application\Identity;

interface AggregateIdGenerator
{
    /**
     * @return string
     */
    public static function generate();
}
