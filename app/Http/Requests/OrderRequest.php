<?php

namespace App\Http\Requests;

use App\DTOs\OrderFormDTO;
use App\DTOs\RegisterFormDTO;
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'comment' => 'nullable|string|max:500',
        ];
    }

    public function toDTO(): OrderFormDTO
    {
        return new OrderFormDTO(
            $this->input('name'),
            $this->input('phone'),
            $this->input('comment'),
            $this->input('product_id'),
        );
    }
}
