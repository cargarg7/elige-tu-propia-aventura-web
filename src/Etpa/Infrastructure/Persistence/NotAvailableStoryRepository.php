<?php

namespace Etpa\Infrastructure\Persistence;

use Etpa\UseCases\Story\StoryRepositoryNotAvailableException;

class NotAvailableStoryRepository implements \Etpa\Domain\StoryRepository
{
    /**
     * {@inheritDoc}
     */
    public function persist($story)
    {
        throw new StoryRepositoryNotAvailableException();
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        throw new StoryRepositoryNotAvailableException();
    }
}
