<?php

namespace UseCase;

use Doctrine\ORM\Session;
use HexArch\UseCase;

class TransactionalUseCaseFactory
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @param Session $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     * Creates a new use case that performs the execution of the
     * given use case atomically
     *
     * @param UseCase $aUseCase
     *
     * @return TransactionalUseCase
     */
    public function newTransactionalUseCaseFrom($aUseCase)
    {
        return new TransactionalUseCase($aUseCase, $this->session);
    }
}
