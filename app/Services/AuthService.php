<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\RegisterFormDto;
use App\Dto\LoginFormDto;
use App\Enum\Roles;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final readonly class AuthService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected RoleRepository $roleRepository
    ) {
    }

    public function createUser(RegisterFormDto $dto): User
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
    public function login(LoginFormDto $dto): true
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

    public function apiLogout(Request $request): bool
    {
        auth()->guard('web')->logout();

        return $request->session()->invalidate();
    }

    public function getUserInfo(): array
    {
        /** @var $user User */
        $user = Auth::user();

        if (is_null($user)) {
            return [];
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role->name
        ];
    }
}
