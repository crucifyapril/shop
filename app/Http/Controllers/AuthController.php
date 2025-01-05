<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController
{
    public function viewFormLogin(): View
    {
        return view('auth.login');
    }

    public function viewFormRegister(): View
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request, AuthService $authService): RedirectResponse
    {
        try {
            $authService->login($request->loginFormData());

            return redirect()->route('index')->with('success', 'Вы успешно вошли в систему.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function register(RegisterRequest $request, AuthService $authService): RedirectResponse
    {
        $authService->createUser($request->toDto());

        return redirect()->route('viewFormLogin')->with('success', 'Регистрация прошла успешно! Пожалуйста, войдите.');
    }

    public function logout(Request $request, AuthService $authService): RedirectResponse
    {
        $authService->logout($request);

        return redirect()->route('index');
    }
}
