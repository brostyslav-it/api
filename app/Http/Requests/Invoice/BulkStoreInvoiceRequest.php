<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            '*.customerId' => ['required', 'integer', 'exists:customers,id'],
            '*.amount' => ['required', 'integer'],
            '*.status' => ['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
            '*.billedAt' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paidAt' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }

    protected function prepareForValidation(): Request
    {
        $data = [];

        foreach ($this->toArray() as $item) {
            $item['customer_id'] = $item['customerId'] ?? null;
            $item['billed_at'] = $item['billedAt'] ?? null;
            $item['paid_at'] = $item['paidAt'] ?? null;

            $data[] = $item;
        }

        return $this->merge($data);
    }
}
