<?php

namespace App\Services;

use App\DTOs\RegisterFormDTO;
use App\DTOs\LoginFormDTO;
use App\Enum\Roles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final class AuthService
{
    public function createUser(RegisterFormDTO $dto): User
    {
        $role = Role::query()->where('name', Roles::BUYER)->first();

        return User::query()->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'role_id' => $role->id,
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginFormDTO $dto): true
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
