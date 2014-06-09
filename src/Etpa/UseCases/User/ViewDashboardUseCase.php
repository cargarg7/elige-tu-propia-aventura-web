<?php

namespace Etpa\UseCases\User;

class ViewDashboardUseCase
{
    /**
     * @var \Etpa\Domain\UserRepository
     */
    private $userRepository;

    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $request
     * @return \Etpa\UseCases\Story\ViewStoryResponse
     */
    public function execute($request)
    {
        $response = new ViewDashboardResponse();
        $response->user = $this->userRepository->find($request->userId);

        return $response;
    }
}
