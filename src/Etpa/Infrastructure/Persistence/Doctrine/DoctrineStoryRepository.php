<?php

namespace Etpa\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;
use \Etpa\Domain\StoryRepository as StoryRepositoryInterface;

class DoctrineStoryRepository extends EntityRepository implements StoryRepositoryInterface
{
    /**
     * @param  \Etpa\Domain\Story $story
     * @return \Etpa\Domain\Story
     */
    public function persist($story)
    {
        $this->_em->persist($story);
        $this->_em->flush($story);
    }
}
