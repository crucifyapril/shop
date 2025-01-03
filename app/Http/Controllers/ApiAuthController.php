<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $this->authService->jwtAuth($request->loginData());
        } catch (Exception) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($data);
    }

    public function logout(): JsonResponse
    {
        try {
            $this->authService->jwtLogout();
        } catch (Exception) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(['success' => true]);
    }

    public function refresh(): JsonResponse
    {
        try {
            $data = $this->authService->jwtRefresh();
        } catch (Exception) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($data);
    }

    public function user(): JsonResponse
    {
        $data = $this->authService->getUserInfo();

        if (empty($data)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($data);
    }
}
