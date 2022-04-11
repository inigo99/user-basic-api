<?php

namespace Tests\app\Application\User;

use App\Application\User\IsUserService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use GrumPHP\Process\TmpFileUsingProcessRunner;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    private IsUserService $userService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->userService = new IsUserService($this->userDataSource);
    }

    /**
     * @test
     */
    public function userNotFound()
    {
        $id = 9999;

        $user = new User($id, "not_existing_email@email.com");

        $this->userDataSource
            ->expects("findByID")
            ->with($id)
            ->once()
            ->andThrow(new Exception('Hubo un error al realizar la peticion'));

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

}
