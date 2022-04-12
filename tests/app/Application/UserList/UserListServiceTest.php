<?php

namespace Tests\app\Application\EarlyAdopter;

use App\Application\UserDataSource\UserDataSource;
use App\Application\UserList\UserListService;
use App\Domain\User;
use PharIo\Manifest\ElementCollectionException;
use Tests\TestCase;
use Exception;

class UserListServiceTest extends TestCase
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
            ->andReturn('[]');

        $this->get('api/users/list');

        $this->userListService->execute();
    }

    /**
     * @test
     */
    public function userList()
    {

        $user1 = new User(1, "user1@email.com");
        $user2 = new User(2, "user2@email.com");
        $user3 = new User(3, "user3@email.com");
        $user4 = new User(4, "user4@email.com");
        $array = array($user1->getId(), $user2->getId(), $user3->getId(), $user4->getId());
        $list = json_encode($array);

        $this->userDataSource
            ->expects('requestList')
            ->once()
            ->andReturn('[1,2,3,4]');

        $userList = $this->userListService->execute();

        $this->assertEquals($list, $userList);

    }

}
