<?php

namespace Etpa\UseCases\Story;

class ViewStoryUseCase
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
     * @param $request
     * @return \Etpa\UseCases\Story\ViewStoryResponse
     */
    public function execute($request)
    {
        $response = new ViewStoryResponse();
        $response->story = $this->storyRepository->find($request->storyId);

        return $response;
    }
}
