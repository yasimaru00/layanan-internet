<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', 
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The service package name is required.',
            'name.string' => 'The service package name must be a string.',
            'name.max' => 'The service package name cannot be longer than 255 characters.',
            'description.required' => 'The service package description is required.',
            'description.string' => 'The service package description must be a string.',
            'price.required' => 'The price of the service package is required.',
            'price.numeric' => 'The price must be a valid number.',
            'price.min' => 'The price must be at least 0.',
        ];
    }
}
