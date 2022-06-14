<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;


class OrdersFilter extends ApiFilter {
    protected $safeParms = [
        'id_client' => ['eq'],
        'id_table' => ['eq'],
        'id_user' => ['eq'],
        'total_price' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status' => ['eq']
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