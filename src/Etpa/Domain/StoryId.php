<?php

namespace Etpa\Domain;

use Etpa\Infrastructure\Persistence\UuidGenerator;

class StoryId
{
    /**
     * @var string
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id ?: UuidGenerator::generate();
    }
}
