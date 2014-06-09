<?php

namespace Etpa\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Etpa\Application\UseCase\TransactionalSession;

class Session implements TransactionalSession
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritDoc}
     */
    public function executeAtomically(callable $operation)
    {
        return $this->entityManager->transactional($operation);
    }
}
