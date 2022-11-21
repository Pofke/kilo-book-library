<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ReservationsFilter extends ApiFilter
{
    protected $safeParams = [
        'bookId' => ['eq'],
        'userId' => ['eq'],
        'status' => ['eq'],
        'extendedDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'returnedDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    ];

    protected $columnMap = [
        'bookId' => 'book_id',
        'userId' => 'user_id',
        'extendedDate' => 'extended_date',
        'returnedDate' => 'returned_date'
    ];
}
