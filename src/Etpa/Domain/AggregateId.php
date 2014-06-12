<?php

namespace Etpa\Domain;

use Etpa\Infrastructure\Identity\UuidGenerator;

abstract class AggregateId
{
    /**
     * @var string
     */
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id ?: UuidGenerator::generate();
    }

    public function id()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->id();
    }
}
