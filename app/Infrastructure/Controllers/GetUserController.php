<?php

namespace App\Infrastructure\Controllers;

use App\Application\User\IsUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class GetUserController extends JsonResponse
{

    private $userServiceController;

    /**
     * @param $userService
     */
    public function __construct(IsUserService $userService)
    {
        $this->userServiceController = $userService;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            $userController = $this->userServiceController->execute($id);
        } catch (Exception $exception) {
            return response()->json([
                'Error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        if(!$userController) {
            return response()->json([
                'Error' => 'No se ha encontrado al usuario'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                "{id:" . $id . ", email: 'useremail@email.com'}"
            ], Response::HTTP_OK);
        }
    }

}


