<?php

namespace Etpa\Domain;

use Etpa\Infrastructure\Identity\UuidGenerator;

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
        $this->id = $id ?: UuidGenerator::generate();
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
