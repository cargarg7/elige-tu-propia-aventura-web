<?php

namespace Etpa\Infrastructure\Persistence\Dummy;

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

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        throw new StoryRepositoryNotAvailableException();
    }
}
