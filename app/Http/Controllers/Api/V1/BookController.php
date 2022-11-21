<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\BooksFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\V1\BookCollection;
use App\Http\Resources\V1\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private function filterNotReturnedBooks($query): void
    {
        $query->where("reservations.status", "!=", "R");
    }

    private function filterBooks($request): BookCollection
    {
        $filter = new BooksFilter();
        $filterItems = $filter->transform($request);
        return Book::where($filterItems);
    }

    public function index(Request $request): BookCollection
    {
        $books = $this->filterBooks($request);
        $books->withCount(['reservations' => function ($query) {
            $this->filterNotReturnedBooks($query);
        }]);
        return new BookCollection($books->paginate()->appends($request->query()));
    }

    public function store(StoreBookRequest $request): BookResource
    {
        return new BookResource(Book::create($request->all()));
    }

    public function show(Book $book): BookResource
    {
        $book->loadCount(['reservations' => function ($query) {
            $this->filterNotReturnedBooks($query);
        }]);
        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book): void
    {
        $book->update($request->all());
    }

    public function destroy(Book $book): void
    {
        $book->delete();
    }
}
