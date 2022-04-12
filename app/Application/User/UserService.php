<?php

namespace App\Application\User;

use App\Application\UserDataSource\UserDataSource;

class UserService
{

    private UserDataSource $userDataSource;

    /**
     * @param $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    public function execute(string $id): bool
    {
        $user = $this->userDataSource->findByID($id);
        $userService = false;

        $idVal = 1000;
        if ($user->getId() < $idVal) {
            $userService = true;
        }

        return $userService;
    }

}
