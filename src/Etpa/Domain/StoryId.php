<?php

namespace Etpa\Domain;

use Etpa\Infrastructure\Identity\UuidGenerator;

class StoryId
{
    /**
     * @var string
     */
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id ?: UuidGenerator::generate();
    }

    public function getId()
    {
        return $this->id;
    }
}
