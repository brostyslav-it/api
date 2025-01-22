<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class ApiFilter
{
    protected array $allowedOperators = [];

    protected array $columnMap = [];

    protected array $operatorMap = [
        'eq' => '=',
        'neq' => '!=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>=',
        'gte' => '>=',
    ];

    public function transform(Request $request): array
    {
        $eloQuery = [];

        foreach ($this->allowedOperators as $field => $allowedOperators) {
            if (empty($query = $request->query($field))) {
                continue;
            }
            $column = $this->columnMap[$field] ?? $field;

            foreach ($allowedOperators as $allowedOperator) {
                if (isset($query[$allowedOperator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$allowedOperator], $query[$allowedOperator]];
                }
            }
        }

        return $eloQuery;
    }
}
