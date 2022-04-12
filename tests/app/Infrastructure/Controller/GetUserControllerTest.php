<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUserControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function generatedGenericError()
    {
        $this->userDataSource
            ->expects('findByID')
            ->with(999)
            ->once()
            ->andThrow(new Exception('Unexpected error'));

        $response = $this->get('/api/users/999');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson(['Error' => 'Unexpected error']);
    }

}
