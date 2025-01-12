<?php

namespace App\Http\Requests;

use App\Dto\OrderFormDto;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'description' => 'nullable|string',
            'promoCode' => 'nullable|string',
        ];
    }

    public function orderFormDto(): OrderFormDto
    {
        return new OrderFormDto(
            $this->input('name'),
            $this->input('email'),
            $this->input('phone'),
            $this->input('description'),
            $this->input('promoCode'),
        );
    }
}
