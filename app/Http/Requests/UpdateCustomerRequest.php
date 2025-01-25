<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->method() === 'PUT' ? [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:1', Rule::in(['I', 'B', 'i', 'b'])],
            'email' => ['required', 'email', 'max:255', 'unique:customers,id'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:20'],
            'postalCode' => ['required', 'string', 'max:10'],
        ] : [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'string', 'max:1', Rule::in(['I', 'B', 'i', 'b'])],
            'email' => ['sometimes', 'required', 'email', 'max:255', 'unique:customers'],
            'address' => ['sometimes', 'required', 'string', 'max:255'],
            'city' => ['sometimes', 'required', 'string', 'max:255'],
            'state' => ['sometimes', 'required', 'string', 'max:20'],
            'postalCode' => ['sometimes', 'required', 'string', 'max:10'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->postal_code) {
            return $this->merge([
                'postal_code' => $this->postalCode,
            ]);
        }
    }
}
