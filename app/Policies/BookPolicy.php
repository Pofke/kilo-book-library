<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Book $book)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Book $book)
    {
        //
    }


    public function takeBookInStock(User $user, int $stockLeft)
    {
        return $stockLeft > 0 ?
            Response::allow() :
            Response::denyWithStatus(
                422,
                'Book is not in stock.'
            );
    }

    public function delete(User $user, Book $book)
    {
        //
    }

    public function restore(User $user, Book $book)
    {
        //
    }

    public function forceDelete(User $user, Book $book)
    {
        //
    }
}
