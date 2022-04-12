<?php

namespace App\Infrastructure\Controllers;

use App\Application\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class GetUserController extends JsonResponse
{

    private UserService $userServiceController;

    /**
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userServiceController = $userService;
    }

    public function __invoke(string $id): JsonResponse
    {
        if($id == null){
            return response()->json([
                'Error' => 'User id not provided'
            ], Response::HTTP_NOT_FOUND); //404
        }else {
            try {
                $userController = $this->userServiceController->execute($id);
            } catch (Exception $exception) {
                return response()->json([
                    //COMPROBAR QUE ERROR SALE AQUÍ POR SI ACASO (PARA QUE NO SEA EL DE USER NOT FOUND)
                    'Error' => $exception->getMessage()
                ], Response::HTTP_BAD_REQUEST); //400
            }

            if (!$userController) {
                return response()->json([
                    'Error' => 'User not found'
                ], Response::HTTP_NOT_FOUND); //404
            } else {
                return response()->json([
                    "{id:" . $id . ", email: 'useremail@email.com'}"
                ], Response::HTTP_OK); //200
            }
        }
    }

}


