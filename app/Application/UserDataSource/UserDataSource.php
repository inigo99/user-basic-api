<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{
    public function findByEmail(string $email): User;
    public function findByID(string $id): User;
    public function requestList(): string;
}
