<?php

namespace App\Infrastructure\Doubles;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDatasource implements UserDataSource
{

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
        $user = new User("userId", $email);
        return $user;
    }

    public function findByID(string $id): User
    {
        $user = new User($id, "useremail@email.com");
        return $user;
    }

    public function requestList(): string
    {
        $user1 = new User(1, "user1@email.com");
        $user2 = new User(2, "user2@email.com");
        $user3 = new User(3, "user3@email.com");
        $user4 = new User(4, "user4@email.com");
        $array = array($user1->getId(), $user2->getId(), $user3->getId(), $user4->getId());
        $list = json_encode($array);
        return $list;
    }

}
