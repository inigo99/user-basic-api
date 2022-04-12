<?php

namespace Tests\app\Application\EarlyAdopter;

use App\Application\UserDataSource\UserDataSource;
use App\Application\UserList\UserListService;
use App\Domain\User;
use PharIo\Manifest\ElementCollectionException;
use Tests\TestCase;
use Exception;

class IsUserListServiceTest extends TestCase
{

    private UserListService $userListService;
    private UserDataSource $userDataSource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = \Mockery::mock(UserDataSource::class);

        $this->userListService = new UserListService($this->userDataSource);
    }

    /**
     * @test
     */
    public function userListEmpty()
    {
        $this->userDataSource
            ->expects('requestList')
            ->once()
            ->return('[]');

        $this->get('api/users/list');

        $this->userListService->execute();
    }

    /**
     * @test
     */
    public function userList()
    {
        $this->userDataSource
            ->expects('requestList')
            ->once()
            ->andReturn();

        $userList = $this->userListService->execute();

        $this->assertTrue($userList);
    }

}
