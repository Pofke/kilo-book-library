<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\BooksFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\BulkStoreBooksRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\V1\BookCollection;
use App\Http\Resources\V1\BookResource;
use App\Models\Book;
use App\Services\Commands\Books\GetStockQuantity;
use App\Services\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BookController extends Controller
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function index(Request $request): BookCollection
    {
        return $this->bookRepository->getBooks($request);
    }

    public function store(StoreBookRequest $request): BookResource
    {
        return $this->bookRepository->createBook($request);
    }

    public function takeBook(Book $book)
    {
        $this->authorize('takeBookInStock', [Book::class, (new GetStockQuantity())->execute($book->id)]);
        $this->bookRepository->takeBook($book);
    }

    public function show(Book $book): BookResource
    {
        return $this->bookRepository->getBook($book);
    }

    public function update(UpdateBookRequest $request, Book $book): void
    {
        $this->bookRepository->updateBook($request, $book);
    }

    public function destroy(Book $book): void
    {
        $this->bookRepository->deleteBook($book);
    }

    public function bulkStore(BulkStoreBooksRequest $request)
    {
         Book::insert($request->toArray());
    }
}
