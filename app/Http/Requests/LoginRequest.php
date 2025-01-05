<?php

namespace App\Http\Requests;

use App\Dto\LoginFormData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Имя обязательно для заполнения.',
            'password.required' => 'Пароль обязателен для заполнения.',
            'email.wrong' => 'Неправильный email или пароль.',
            'password.wrong' => 'Неправильный email или пароль.',
        ];
    }

    public function loginFormData(): LoginFormData
    {
        return new LoginFormData(
            $this->input('email'),
            $this->input('password')
        );
    }
}
