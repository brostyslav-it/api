<?php

namespace App\Filters;

class CustomersFilter extends ApiFilter
{
    protected array $allowedOperators = [
        'id' => ['eq'],
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected array $columnMap = [
        'postalCode' => 'postal_code',
    ];
}
