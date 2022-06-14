<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;


class MenusFilter extends ApiFilter {
    protected $safeParms = [
        'name' => ['eq'],
        'description' => ['eq']
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