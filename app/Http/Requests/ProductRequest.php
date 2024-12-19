<?php

namespace App\Http\Requests;

use App\DTOs\ProductFormDTO;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable', 'string', 'max:255'],
            'quantity' => ['required', 'numeric'],
            'is_available' => ['required', 'boolean']
        ];
    }

    public function toDTO(): ProductFormDTO
    {
        return new ProductFormDTO(
            $this->input('name'),
            $this->input('price'),
            $this->input('description'),
            $this->input('quantity'),
            $this->input('is_available')
        );
    }
}
