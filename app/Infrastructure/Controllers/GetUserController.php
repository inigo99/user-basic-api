<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserController extends BaseController
{
    public function __invoke(string $userId): JsonResponse
    {
        return response()->json([
            'error' => "user does not exist"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function genericErrorGiven()
    {
        return response()->json(['error' => "Hubo un error al realizar la petición"], Response::HTTP_BAD_REQUEST);
    }

}


