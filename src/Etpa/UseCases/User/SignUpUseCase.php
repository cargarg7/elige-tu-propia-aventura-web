<?php

namespace Etpa\UseCases\Story;

class SignUpUseCase
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
     * @param \Etpa\UseCases\User\SignUpRequest $request
     * @throws UserAlreadyExistException
     * @return \Etpa\UseCases\User\SignUpResponse
     */
    public function execute($request)
    {
        $user = $this->userRepository->find($request->email);
        if ($user) {
            throw new UserAlreadyExistException();
        }

        $user = new User();
        $user->setEmail($request->email);
        $user->setName();

        $response = new ViewStoryResponse();

        $response->user = $this->storyRepository->find($request->storyId);
        return $response;
    }
}
