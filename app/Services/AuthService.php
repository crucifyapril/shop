<?php

namespace App\Services;

use App\DTOs\RegisterFormDTO;
use App\DTOs\LoginFormDTO;
use App\Enum\Roles;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final class AuthService
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository,
        protected readonly RoleRepositoryInterface $roleRepository
    )
    {

    }

    public function createUser(RegisterFormDTO $dto)
    {
        $role = $this->roleRepository->findByName(Roles::BUYER);

        return $this->userRepository->create([
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
