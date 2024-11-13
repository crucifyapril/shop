<?php

namespace App\Http\Requests;

use App\DTOs\RegisterFormDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения.',
            'name.unique' => 'Имя уже занято.',
            'email.required' => 'Email обязателен для заполнения.',
            'email.unique' => 'Email уже зарегистрирован.',
            'password.required' => 'Пароль обязателен для заполнения.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.min' => 'Пароль должен состоять минимум из 8 символов.',
        ];
    }

    public function toDTO(): RegisterFormDTO
    {
        return new RegisterFormDTO(
            $this->input('name'),
            $this->input('email'),
            bcrypt($this->input('password'))
        );
    }
}
