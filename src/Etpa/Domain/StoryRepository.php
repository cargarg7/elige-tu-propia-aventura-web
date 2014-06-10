<?php

namespace Etpa\Domain;

interface StoryRepository
{
    /**
     * @param int $id
     * @return \Etpa\Domain\Story $story
     */
    public function find($id);

    /**
     * @param  \Etpa\Domain\Story $story
     */
    public function persist($story);

    /**
     * @return \Etpa\Domain\Story[]
     * @throws \Etpa\UseCases\Story\CouldNotFetchStoriesException
     */
    public function findAll();
}
