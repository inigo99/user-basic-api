<?php

namespace App\Infrastructure\Doubles;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDatasource implements UserDataSource
{

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function findByID(string $id): User
    {
        // TODO: Implement findByID() method.
    }

    public function requestList(): array
    {
        // TODO: Implement requestList() method.
    }
}
