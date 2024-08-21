<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required',
            'telp' => 'required',
            'address' => 'required',
            'sales_id' => 'required',
            'service_package_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The customer name is required.',
            'telp.required' => 'The phone number is required.',
            'address.required' => 'The address is required.',
            'sales_id.required' => 'The sales ID is required.',
            'service_package_id.required' => 'The service package ID is required.',
        ];
    }
}
