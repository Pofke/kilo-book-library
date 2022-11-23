<?php

namespace App\Services\Commands\Books;

use App\Models\Book;

class GetStockQuantity
{
    public function execute($bookId): int
    {
        return Book::selectRaw('(books.quantity - count(reservations.id)) as currentStock')
            ->where([['books.id', '=', $bookId], ['reservations.status', '!=', 'R']])
            ->leftJoin('reservations', 'books.id', '=', 'reservations.book_id')
            ->groupBy("books.id", "books.quantity")
            ->first()["currentStock"];
    }
}
