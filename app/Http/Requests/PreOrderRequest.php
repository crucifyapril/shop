<?php

namespace App\Http\Requests;

use App\Dto\PreOrderFormDto;
use Illuminate\Foundation\Http\FormRequest;

class PreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'email' => 'required|string|email',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function preOrderFormDto(): PreOrderFormDto
    {
        return new PreOrderFormDto(
            $this->input('email'),
            $this->input('description'),
            $this->input('product_id')
        );
    }
}
