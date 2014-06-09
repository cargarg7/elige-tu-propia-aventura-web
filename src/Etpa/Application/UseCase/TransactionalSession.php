<?php

namespace Etpa\Application\UseCase;

interface TransactionalSession
{
    public function executeAtomically(callable $operation);
}
