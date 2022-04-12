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
                'Error' => 'User ID not provided'
            ], Response::HTTP_BAD_REQUEST);
        }else {
            try {
                $userController = $this->userServiceController->execute($id);
            } catch (Exception $exception) {
                return response()->json([
                    'Error' => $exception->getMessage()
                ], Response::HTTP_BAD_REQUEST);
            }

            if (!$userController) {
                return response()->json([
                    'Error' => 'User not found'
                ], Response::HTTP_NOT_FOUND);
            } else {
                return response()->json([
                    "{id:" . $id . ", email: 'useremail@email.com'}"
                ], Response::HTTP_OK);
            }
        }
    }

}


