<?php

namespace App\Application\UserList;

use App\Application\UserDataSource\UserDataSource;

class UserListService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * EarlyAdopterService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    public function execute(): array
    {
        $userList = $this->userDataSource->requestList();

        return $userList;
    }

}
