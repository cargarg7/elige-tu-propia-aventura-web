<?php

namespace Etpa\Domain;

class StoryId
{
    /**
     * @var int
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id ?: 1;
    }
}
