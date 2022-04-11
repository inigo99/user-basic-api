<?php

namespace App\Application\UserListAdopter;

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

    public function execute(): array
    {
        $userList = $this->userDataSource->requestList();

        return $userList;
    }

}
