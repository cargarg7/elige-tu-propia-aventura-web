<?php

namespace Etpa\Tests\UseCases\CreateStory;

use Etpa\Tests\Infrastructure\Persistence\NotAvailableStoryRepository;
use Etpa\UseCases\Story\CreateStoryUseCase;

class CreateStoryUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Etpa\UseCases\Story\CreateStoryException
     */
    public function ifRepositoryIsNotAvailableAnExceptionShouldBeThrown()
    {
        $request = $this->buildRequest();
        $storyRepository = new NotAvailableStoryRepository();
        $this->executeRequest($storyRepository, $request);
        $this->assertNull(null);
    }

    /**
     * @atest
     */
    public function itShouldReturnAValidIdForANewStory()
    {
        $request = $this->buildRequest();
        $storyRepository = new StoryRepository();
        $response = $this->executeRequest($storyRepository, $request);
        $this->assertSame(1, $response->story->getId());
    }

    /**
     * @param $storyRepository
     * @param $request
     * @return \Etpa\UseCases\Story\CreateStoryResponse
     */
    private function executeRequest($storyRepository, $request)
    {
        return (new CreateStoryUseCase($storyRepository))->execute($request);
    }

    /**
     * @return \stdClass
     */
    private function buildRequest()
    {
        $request = new \stdClass();
        $request->title = '#title#';

        return $request;
    }
}
