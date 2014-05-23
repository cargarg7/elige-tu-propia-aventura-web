<?php

namespace Etpa\Domain;

interface UserRepository
{
    /**
     * @param  \Etpa\Domain\User $user
     * @return \Etpa\Domain\User
     */
    public function persist($user);

    /**
     * @param string $email
     * @return \Etpa\Domain\User
     */
    public function find($email);
}
