<?php

namespace Etpa\Domain;

use Etpa\Infrastructure\Identity\Uuid\UuidAggregateIdGenerator;

/**
 * Class AggregateId
 * @package Etpa\Domain
 */
abstract class AggregateId
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @param string $id
     */
    public function __construct($id = null)
    {
        $this->id = $id ?: UuidAggregateIdGenerator::generate();
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id();
    }
}
