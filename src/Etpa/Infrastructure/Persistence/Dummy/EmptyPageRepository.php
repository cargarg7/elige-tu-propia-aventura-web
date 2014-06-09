<?php

namespace Etpa\Infrastructure\Persistence\Dummy;

use Etpa\Domain\PageRepository;

class EmptyPageRepository implements PageRepository
{
    /**
     * {@inheritDoc}
     */
    public function persist($story)
    {
        // TODO: Implement persist() method.
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        return [];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return null;
    }
}
