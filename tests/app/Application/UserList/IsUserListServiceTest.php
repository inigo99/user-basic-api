<?php

namespace Tests\app\Application\EarlyAdopter;

use App\Application\UserDataSource\UserDataSource;
use App\Application\UserListAdopter\IsUserListService;
use App\Domain\User;
use PharIo\Manifest\ElementCollectionException;
use Tests\TestCase;
use Exception;

class IsUserListServiceTest extends TestCase
{

    private IsUserListService $isUserListAdopterService;
    private UserDataSource $userDataSource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = \Mockery::mock(UserDataSource::class);

        $this->isUserListAdopterService = new IsUserListService($this->userDataSource);
    }

    /**
     * @test
     */
    public function userListEmpty()
    {
        $this->userDataSource
            ->expects('requestList')
            ->once()
            ->andThrow(new Exception("Hubo un error al realizar la peticion"));

        $this->expectException(Exception::class);

        $this->isUserListAdopterService->execute();
    }



}
