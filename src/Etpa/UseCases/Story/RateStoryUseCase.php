<?php

namespace Etpa\UseCases\Story;

/**
 * Class RateStoryUseCase
 * @package Etpa\UseCases\Story
 */
class RateStoryUseCase
{
    /**
     * @var \Etpa\Domain\StoryRepository
     */
    private $storyRepository;

    public function __construct($storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }

    /**
     * @param  CreateStoryRequest  $request
     * @return CreateStoryResponse
     */
    public function execute($request)
    {
        $story = $this->storyRepository->find($request->storyId);
        $story->rate($request->rating);
        $this->storyRepository->persist($story);

        return $this->createResponse($story);
    }

    /**
     * @param $story
     * @return CreateStoryResponse
     */
    private function createResponse($story)
    {
        $response = new RateStoryResponse();
        $response->story = $story;

        return $response;
    }
}
