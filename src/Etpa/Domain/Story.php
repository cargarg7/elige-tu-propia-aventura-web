<?php

namespace Etpa\Domain;

class Story
{
    use Validator;

    const TITLE_MAX_LENGTH = 250;
    const DESCRIPTION_MAX_LENGTH = 1500;

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
     * @var Page
     */
    private $firstPage;

    /**
     * @var Page[]
     */
    private $pages;

    /**
     * @var int
     */
    private $status;

    public function __construct($title, $description)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setStatus(StoryStatus::DRAFT);
    }

    /**
     * @param int $id
     * @return $this
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    private function setTitle($title)
    {
        $this->assertStringLengthIsLessOrEqual($title, self::TITLE_MAX_LENGTH);
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    private function setDescription($description)
    {
        $this->assertStringLengthIsLessOrEqual($description, self::DESCRIPTION_MAX_LENGTH);
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param \Etpa\Domain\Page $firstPage
     * @todo DDD missing
     * @return $this
     */
    public function setFirstPage($firstPage)
    {
        $this->firstPage = $firstPage;

        return $this;
    }

    /**
     * @return \Etpa\Domain\Page
     */
    public function open()
    {
        return $this->firstPage;
    }

    private function setStatus($status)
    {
        $this->status = $status;
    }
}
