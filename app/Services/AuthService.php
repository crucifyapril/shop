<?php

namespace App\Services;

use App\Dto\RegisterFormDto;
use App\Dto\LoginFormData;
use App\Enum\Roles;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    public function login(LoginFormData $dto): true
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

    /**
     * @throws Exception
     */
    public function jwtAuth(LoginFormData $credentials): array
    {
        $token = JWTAuth::attempt($credentials->toArray());

        if ($token === false) {
            throw new Exception('Неверный логин или пароль');
        }

        return ['token' => $token];
    }

    public function jwtRefresh(): array
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());

        return ['token' => $token];
    }

    /**
     * @throws Exception
     */
    public function jwtLogout(): void
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }
}
