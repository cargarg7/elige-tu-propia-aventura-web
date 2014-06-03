<?php

namespace Etpa\Domain;

use Doctrine\Common\Collections\ArrayCollection;

class Page
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Action[]
     */
    private $actions;

    /**
     * @var Story
     */
    private $story;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param Action $page
     * @return $this
     */
    public function addPage($page)
    {
        $this->actions[$page->getId()] = $page;

        return $this;
    }

    /**
     * @return Page[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    public function goToPage($id)
    {
        if (!isset($this->actions[$id])) {
            throw new NonExistingPageException();
        }

        return $this->actions[$id];
    }

    /**
     * @param \Etpa\Domain\Story $story
     * @return $this
     */
    public function setStory($story)
    {
        $this->story = $story;

        return $this;
    }

    /**
     * @return \Etpa\Domain\Story
     */
    public function getStory()
    {
        return $this->story;
    }
}
