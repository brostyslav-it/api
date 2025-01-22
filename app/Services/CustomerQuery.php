<?php

namespace App\Services;

use Illuminate\Http\Request;

class CustomerQuery
{
    protected static array $allowedOperators = [
        'id' => ['eq'],
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected static array $columnMap = [
        'postalCode' => 'postal_code',
    ];

    protected static array $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>=',
        'gte' => '>=',
    ];

    public static function transform(Request $request): array
    {
        $eloQuery = [];

        foreach (self::$allowedOperators as $field => $allowedOperators) {
            if (empty($query = $request->query($field))) {
                continue;
            }
            $column = self::$columnMap[$field] ?? $field;

            foreach ($allowedOperators as $allowedOperator) {
                if (isset($query[$allowedOperator])) {
                    $eloQuery[] = [$column, self::$operatorMap[$allowedOperator], $query[$allowedOperator]];
                }
            }
        }

        return $eloQuery;
    }
}
