<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer\Enums\CustomerType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->tokenCan('update');
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:1', Rule::in(CustomerType::toArray())],
            'email' => ['required', 'email', 'max:255', 'unique:customers,id'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:20'],
            'postalCode' => ['required', 'string', 'max:10'],
        ];

        return $this->method() === 'PUT'
            ? $rules
            : array_map(fn (array $rule) => ['sometimes', ...$rule], $rules);
    }

    protected function prepareForValidation(): Request
    {
        if ($postalCode = $this->{'postalCode'}) {
            return $this->merge(['postal_code' => $postalCode]);
        }

        return $this;
    }
}
