<?php

namespace App\Http\Requests;

use App\DTOs\OrderFormDTO;
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
            'product_id' => 'required|exists:products,id',
        ];
    }

    public function toDTO(): OrderFormDTO
    {
        return new OrderFormDTO(
            $this->input('name'),
            $this->input('email'),
            $this->input('phone'),
            $this->input('description'),
            $this->input('product_id'),
        );
    }
}
