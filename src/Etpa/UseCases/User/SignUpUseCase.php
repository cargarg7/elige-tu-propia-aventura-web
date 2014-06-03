<?php

namespace Etpa\UseCases\Story;

use Etpa\Domain\User;
use Etpa\UseCases\User\SignUpResponse;

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

        $this->userRepository->persist(
            new User(
                $request->email,
                $request->name,
                $request->lastName
            )
        );

        $response = new SignUpResponse();
        $response->user = $user;

        return $response;
    }
}
