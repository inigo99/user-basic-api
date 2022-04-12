<?php

namespace App\Infrastructure\Controllers;

use App\Application\EarlyAdopter\EarlyAdopterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class EarlyAdopterUserController extends BaseController
{
    private EarlyAdopterService $isEarlyAdopterService;

    /**
     * EarlyAdopterUserController constructor.
     */
    public function __construct(EarlyAdopterService $isEarlyAdopterService)
    {
        $this->isEarlyAdopterService = $isEarlyAdopterService;
    }

    public function __invoke(string $email): JsonResponse
    {
        try {
            $isEarlyAdopter = $this->isEarlyAdopterService->execute($email);
        } catch (Exception $exception) {
            return response()->json([
                'Error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'earlyAdopter' => $isEarlyAdopter
        ], Response::HTTP_OK);
    }
}
