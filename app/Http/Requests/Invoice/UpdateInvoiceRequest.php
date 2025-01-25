<?php

namespace App\Http\Requests\Invoice;

use App\Models\Invoice\Enums\InvoiceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->tokenCan('update');
    }

    public function rules(): array
    {
        $rules = [
            'customerId' => ['required', 'integer', 'exists:customers,id'],
            'amount' => ['required', 'integer'],
            'status' => ['required', Rule::in(InvoiceStatus::toArray())],
            'billedAt' => ['required', 'date_format:Y-m-d H:i:s'],
            'paidAt' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];

        return $this->method() === 'PUT'
            ? $rules
            : array_map(fn (array $rule) => ['sometimes', ...$rule], $rules);
    }

    protected function prepareForValidation(): Request
    {
        $data = [];

        if ($customerId = $this->{'customerId'}) {
            $data['customer_id'] = $customerId;
        }

        if ($billedAt = $this->{'billedAt'}) {
            $data['billed_at'] = $billedAt;
        }

        if ($paidAt = $this->{'paidAt'}) {
            $data['paid_at'] = $paidAt;
        }

        return empty($data) ? $this : $this->merge($data);
    }
}
