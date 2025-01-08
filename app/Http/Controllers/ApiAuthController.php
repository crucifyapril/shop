<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(Auth::user());
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->authService->createUser($request->toDto());
        } catch (Exception) {
            return response()->json(['success' => false], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(['success' => true]);
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $result = $this->authService->apiLogout($request);
        } catch (Exception) {
            return response()->json(['success' => false], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(['success' => $result]);
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
