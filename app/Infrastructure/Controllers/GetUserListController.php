<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserList\UserListService;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetUserListController extends BaseController
{

    private $GetUserListController;

    /**
     * @param $GetUserListController
     */
    public function __construct(UserListService $GetUserListController)
    {
        $this->GetUserListController = $GetUserListController;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $userListController = $this->GetUserListController->execute();
        } catch (Exception $exception) {
            return response()->json([
                'Error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'GetUserListController' => $userListController
        ], Response::HTTP_BAD_REQUEST);
    }

}
