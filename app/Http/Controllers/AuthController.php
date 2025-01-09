<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

readonly class AuthController
{
    public function __construct(
        private AuthService $authService
    ) {
    }

    public function viewFormLogin(): View
    {
        return view('auth.login');
    }

    public function viewFormRegister(): View
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $this->authService->login($request->loginFormDto());

            return redirect()->route('index')->with('success', 'Вы успешно вошли в систему.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->authService->createUser($request->toDto());

        return redirect()->route('viewFormLogin')->with('success', 'Регистрация прошла успешно! Пожалуйста, войдите.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        return redirect()->route('index');
    }
}
