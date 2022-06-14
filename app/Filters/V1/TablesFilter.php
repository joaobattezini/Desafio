<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;


class TablesFilter extends ApiFilter {
    protected $safeParms = [
        'number' => ['eq'],
    ];

    protected $columnMap = [];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}