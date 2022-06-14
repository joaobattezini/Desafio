<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;


class ClientsFilter extends ApiFilter {
    protected $safeParms = [
        'name' => ['eq'],
        'cpf' => ['eq']
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