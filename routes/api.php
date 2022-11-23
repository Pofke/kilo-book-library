<?php

use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::apiResource('reservations', ReservationController::class);

    Route::get('books/{book}/take', [BookController::class, 'takeBook']);
    Route::post('books/bulk', [BookController::class, 'bulkStore']);


    Route::get('reservations/{reservation}/extend', [ReservationController::class, 'extendBook']);
    Route::get('reservations/{reservation}/return', [ReservationController::class, 'returnBook']);
    //Route::post('invoices/bulk', [InvoiceController::class, 'bulkStore']);
});
