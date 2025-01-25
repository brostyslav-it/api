<?php

namespace App\Http\Requests\Invoice;

use App\Models\Invoice\Enums\InvoiceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->tokenCan('create');
    }

    public function rules(): array
    {
        return [
            '*.customerId' => ['required', 'integer', 'exists:customers,id'],
            '*.amount' => ['required', 'integer'],
            '*.status' => ['required', Rule::in(InvoiceStatus::toArray())],
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
