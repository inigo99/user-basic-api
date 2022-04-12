<?php

namespace Tests\app\Application\User;

use App\Application\User\UserService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use GrumPHP\Process\TmpFileUsingProcessRunner;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    private UserService $userService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->userService = new UserService($this->userDataSource);
    }

    /**
     * @test
     */
    public function userNotFound()
    {
        $id = 9999;

        $user = new User($id, "notexistingemail@email.com");

        $this->userDataSource
            ->expects("findByID")
            ->with($id)
            ->once()
            ->andThrow(new Exception('Error while doing request'));

        $this->expectException(Exception::class);

        $this->userService->execute($id);
    }

    /**
     * @test
     */
    public function userExists()
    {
        $id = 1;

        $user = new User($id, "user@email.com");

        $this->userDataSource
            ->expects('findByID')
            ->with($id)
            ->once()
            ->andReturn($user);

        $userService = $this->userService->execute($id);

        $this->assertTrue($userService);
    }

    /**
     * @test
     */
    public function userWithNoIDGiven()
    {
        $id = 9999;

        $this->userDataSource
            ->expects('findByID')
            ->with($id)
            ->once()
            ->andThrow(new Exception('User ID not provided'));

        $this->expectException(Exception::class);

        $this->userService->execute($id);

    }

}
