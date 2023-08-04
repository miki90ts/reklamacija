<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required'],
            'store_id' => ['required'],
            'warranty_length_id' => ['required'],
            'purchased_at' => ['required', 'date'],
            'photo' => ['required','image'],
            'price' => ['required','decimal:0,2'],
            'note' => ['nullable', 'string']
        ];
    }
}
