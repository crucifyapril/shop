<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
            $data = $this->authService->jwtAuth($request->loginFormData());
        } catch (Exception) {
            return response()->json(['success' => false], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($data);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->authService->createUser($request->toDTO());
        } catch (Exception) {
            return response()->json(['success' => false], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(['success' => true]);
    }

    public function logout(): JsonResponse
    {
        try {
            $this->authService->jwtLogout();
        } catch (Exception) {
            return response()->json(['success' => false], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(['success' => true]);
    }

    public function refresh(): JsonResponse
    {
        try {
            $data = $this->authService->jwtRefresh();
        } catch (Exception) {
            return response()->json(['success' => false], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($data);
    }

    public function user(): JsonResponse
    {
        $data = $this->authService->getUserInfo();

        if (empty($data)) {
            return response()->json(['success' => false], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($data);
    }
}
