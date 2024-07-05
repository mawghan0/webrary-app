<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

// User
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

// Book
Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::post('books', [BookController::class, 'store']);
Route::put('books/{id}', [BookController::class, 'update']);
Route::delete('books/{id}', [BookController::class, 'destroy']);

// Borrowing
Route::get('borrowings', [BorrowingController::class, 'index']);
Route::get('borrowings/{id}', [BorrowingController::class, 'show']);
Route::post('borrowings', [BorrowingController::class, 'store']);
Route::put('borrowings/{id}', [BorrowingController::class, 'update']);
Route::delete('borrowings/{id}', [BorrowingController::class, 'destroy']);

// Review
Route::get('reviews', [ReviewController::class, 'index']);
Route::get('reviews/{id}', [ReviewController::class, 'show']);
Route::post('reviews', [ReviewController::class, 'store']);
Route::put('reviews/{id}', [ReviewController::class, 'update']);
Route::delete('reviews/{id}', [ReviewController::class, 'destroy']);
