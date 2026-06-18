<?php

use App\Http\Controllers\ApiBookController;
use App\Http\Controllers\ApiBorrowerController;
use App\Http\Controllers\ApiBorrowingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/books', [ApiBookController::class, 'index']);
Route::post('/books', [ApiBookController::class, 'store']);
Route::get('/books/{id}', [ApiBookController::class, 'show']);
Route::put('/books/{id}', [ApiBookController::class, 'update']);
Route::delete('/books/{id}', [ApiBookController::class, 'destroy']);

// borrowers
Route::get('/borrower', [ApiBorrowerController::class, 'index']);
Route::post('/borrower', [ApiBorrowerController::class, 'store']);
Route::get('/borrower/{id}', [ApiBorrowerController::class, 'show']);
Route::put('/borrower/{id}', [ApiBorrowerController::class, 'update']);
Route::delete('/borrower/{id}', [ApiBorrowerController::class, 'destroy']);

//borrowing
Route::get('/borrowing', [ApiBorrowingController::class, 'index']);
Route::post('/borrowing', [ApiBorrowingController::class, 'store']);
Route::get('/borrowing/{id}', [ApiBorrowingController::class, 'show']);
Route::put('/borrowing/{id}', [ApiBorrowingController::class, 'update']);
Route::delete('/borrowing/{id}', [ApiBorrowingController::class, 'destroy']);
