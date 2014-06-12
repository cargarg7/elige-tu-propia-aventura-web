<?php

namespace Etpa\Infrastructure\Persistence\Redis;

use Predis\Client;

class RedisStoryRepository implements \Etpa\Domain\StoryRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Client();
    }

    /**
     * @param  \Etpa\Domain\Story $story
     * @return \Etpa\Domain\Story
     */
    public function persist($story)
    {
        $this->connection->set('story:'.$story->getId(), serialize($story));
    }

    /**
     * @return \Etpa\Domain\Story[]
     * @throws \Etpa\UseCases\Story\CouldNotFetchStoriesException
     */
    public function findAll()
    {
        $keys = $this->connection->keys('*');
        $result = array();
        $items = $this->connection->mget(array_values($keys));
        foreach ($items as $item) {
            $result[] = unserialize($item);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return \Etpa\Domain\Story $story
     */
    public function find($id)
    {
        $item = $this->connection->get('story:'.$id);
        if (!$item) {
            return null;
        }

        return unserialize($item);
    }
}
