<?php

namespace App\Services\Commands\Books;

class GetNotReturnedBooks
{
    public function execute($query): void
    {
        $query->where("reservations.status", "!=", "R");
    }
}
