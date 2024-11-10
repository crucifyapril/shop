<?php

namespace App\Services;

use App\DTOs\CreateUserDTO;
use App\DTOs\LoginUserDTO;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function createUser(CreateUserDTO $dto): User
    {
        return User::query()->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginUserDTO $dto): true
    {
        if (!Auth::attempt(['email' => $dto->email, 'password' => $dto->password])) {
            throw ValidationException::withMessages([
                'email' => ['Эти учетные данные не соответствуют нашим записям.'],
            ]);
        }

        return true;
    }

    public function logout(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
