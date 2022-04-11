<?php

namespace App\Application\UserList;

use App\Application\UserDataSource\UserDataSource;

class IsUserListService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * IsEarlyAdopterService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    public function execute(): string
    {
        $userList = $this->userDataSource->requestList();

        return $userList;
    }

}
