<?php

namespace Etpa\Domain;

class Action
{
    private $id;
    private $fromPage;
    private $toPage;
    private $name;

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Page
     */
    public function nextPage()
    {
        return $this->toPage;
    }
}
