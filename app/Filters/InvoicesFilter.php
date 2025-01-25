<?php

namespace App\Filters;

class InvoicesFilter extends ApiFilter
{
    protected array $allowedOperators = [
        'id' => ['eq'],
        'customerId' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'amount' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'status' => ['eq'],
        'billedAt' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'paidAt' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected array $columnMap = [
        'billedAt' => 'billed_at',
        'paidAt' => 'paid_at',
    ];
}
