<?php

namespace Etpa\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Etpa\Application\DomainEventPublisher;

class Story
{
    use Validator;

    const TITLE_MAX_LENGTH = 250;
    const DESCRIPTION_MAX_LENGTH = 1500;

    /**
     * @var string
     */
    private $id;

    /**
     * @var StoryId
     */
    private $storyId;

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

    /**
     * @var int
     */
    private $rating = null;

    /**
     * @var int
     */
    private $votes = 0;

    /**
     * @param StoryId $storyId
     * @param string $title
     * @param string $description
     * @throws \Exception
     */
    public function __construct(StoryId $storyId, $title, $description)
    {
        $this->setId($storyId);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setStatus(StoryStatus::DRAFT);
        $this->setVotes(0);
        $this->setRating(null);
        $this->setPages(new ArrayCollection());
    }

    /**
     * @param $storyId
     * @return $this
     * @throws \Exception
     */
    private function setId(StoryId $storyId)
    {
        if (null !== $this->storyId) {
            throw new \Exception('Id must not be changed');
        }

        $this->id = $storyId->id();
        $this->storyId = $storyId;

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
     * @param $status
     * @return $this
     */
    private function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return StoryId
     */
    public function getId()
    {
        return new StoryId($this->id);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
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
     * @return float
     */
    public function getRating()
    {
        if (null === $this->rating) {
            return null;
        }

        return (float) ($this->rating / 100);
    }

    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param \Etpa\Domain\Page $firstPage
     * @return $this
     */
    public function chooseFirstPage($firstPage)
    {
        $this->firstPage = $firstPage;

        return $this;
    }

    /**
     * @return \Etpa\Domain\Page
     */
    public function start()
    {
        return $this->firstPage;
    }

    /**
     * @param int $rating
     * @return $this
     */
    public function rate($rating)
    {
        $this->rating = (($this->rating * $this->votes) + ($rating * 100)) / $this->incrementVotes();

        DomainEventPublisher::getInstance()->publish(
            new StoryRated(
                $this->id,
                $rating
            )
        );

        return $this;
    }

    private function incrementVotes()
    {
        return ++$this->votes;
    }

    private function setVotes($votes)
    {
        $this->votes = $votes;

        return $this;
    }

    private function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @param Page[] $pages
     */
    private function setPages($pages)
    {
        $this->pages = $pages;
    }
}
