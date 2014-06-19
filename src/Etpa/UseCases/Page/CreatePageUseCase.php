<?php

namespace Etpa\UseCases\Page;

class CreatePageUseCase
{
    /**
     * @var \Etpa\Domain\PageRepository
     */
    private $pageRepository;

    public function __construct($pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param  CreatePageRequest   $request
     * @return CreatePageResponse
     * @throws CreatePageException
     */
    public function execute($request)
    {
        $page = $this->tryToCreatePageFromRequest($request);
        $this->tryToSavePage($page);

        return $this->createResponse($page);
    }

    /**
     * @param $request
     * @return Page
     * @throws CreatePageException
     */
    private function tryToCreatePageFromRequest($request)
    {
        try {
            return $this->createPageFromRequest($request);
        } catch (\Exception $e) {
            throw new CreatePageException('There is some validation problem.');
        }
    }

    /**
     * @param $request
     * @return Page
     */
    private function createPageFromRequest($request)
    {
        $page = new Page(
            new PageId(),
            $request->title,
            $request->description
        );

        return $page;
    }

    /**
     * @param $page
     * @throws CreatePageException
     */
    private function tryToSavePage($page)
    {
        try {
            $this->savePage($page);
        } catch (\Exception $e) {
            throw new CreatePageException();
        }
    }

    /**
     * @param $page
     */
    private function savePage($page)
    {
        $this->pageRepository->persist($page);
    }

    /**
     * @param $page
     * @return CreatePageResponse
     */
    private function createResponse($page)
    {
        $response = new CreatePageResponse();
        $response->page = $page;

        return $response;
    }
}
