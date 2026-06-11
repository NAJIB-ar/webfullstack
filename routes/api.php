<?php

use App\Http\Controllers\ApiBookController;
use App\Http\Controllers\ApiBorrowerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/books', [ApiBookController::class, 'index']);
Route::post('/books', [ApiBookController::class, 'store']);
Route::get('/books/{$id}', [ApiBookController::class, 'show']);
Route::put('/books/{$id}', [ApiBookController::class, 'update']);
Route::delete('/books/{id}', [ApiBookController::class, 'delete']);

// borrowers
Route::get('/borrower', [ApiBorrowerController::class, 'index']);
Route::post('/borrower', [ApiBorrowerController::class, 'store']);
Route::get('/borrower/{$id}', [ApiBorrowerController::class, 'show']);
Route::put('/borrower/{$id}', [ApiBorrowerController::class, 'update']);
Route::delete('/borrower/{id}', [ApiBorrowerController::class, 'delete']);