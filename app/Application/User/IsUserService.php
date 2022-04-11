<?php

namespace App\Application\User;

use App\Application\UserDataSource\UserDataSource;

class IsUserService
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

        if ($user->getId() < 1000) {
            $userService = true;
        }

        return $userService;
    }

}
