<?php

namespace UseCase;

use HexArch\Request;
use HexArch\GenericUseCaseResponse;
use Doctrine\ORM\Session;
use HexArch\UseCase;
use LogicException;

class TransactionalUseCase
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var UseCase
     */
    private $useCase;

    /**
     * @param UseCase $useCase
     * @param Session $session
     */
    public function __construct($useCase, $session)
    {
        $this->session = $session;
        $this->useCase = $useCase;
    }

    /**
     * Executes this use case transactionally
     *
     * @param Request $request
     *
     * @throws LogicException
     *
     * @return GenericUseCaseResponse
     */
    public function execute($request)
    {
        if (empty($this->useCase)) {
            throw new LogicException('A use case must be specified');
        }

        $operation = function () use ($request) {
            return $this->useCase->execute($request);
        };

        return $this->session->executeAtomically($operation->bindTo($this));
    }
}
