<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\AuthController;

// login
Route::post('/login', [AuthController::class, 'login']);
// register
Route::post('users', [UserController::class, 'store']);


Route::middleware('auth.json:sanctum')->group(function () {
// profile
Route::put('users/{id}', [UserController::class, 'update']); //done
Route::put('users/{id}', [UserController::class, 'update']); //ngambil nama user
Route::post('/logout', [AuthController::class, 'logout']); //done
// book
Route::get('/books/hero', [BookController::class, 'index2']); //1buku random
Route::get('/books/popular', [BookController::class, 'index3']); //5 buku random
Route::get('/books/rangking', [BookController::class, 'index4']); //4 buku rangking tertinggi
Route::get('/books/new', [BookController::class, 'index5']); //4 buku new tertinggi
Route::get('/books/recomend', [BookController::class, 'index6']); //4 buku random
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
// borrowing
Route::get('borrowings', [BorrowingController::class, 'index']); //where user_id == id(users)
Route::get('borrowings/borrow', [BorrowingController::class, 'index2']); //where user_id == id(users) where status=borrowed
Route::get('borrowings/return', [BorrowingController::class, 'index2']); //where user_id == id(users) where status=returned
Route::get('borrowings/{id}', [BorrowingController::class, 'show']); 
Route::post('borrowings', [BorrowingController::class, 'store']);
// review
Route::get('reviews', [ReviewController::class, 'index']);
Route::post('reviews', [ReviewController::class, 'store']);
});
