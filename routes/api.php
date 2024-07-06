<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\AuthController;

// login
Route::post('/login', [AuthController::class, 'login']); //done
// register
Route::post('users', [UserController::class, 'store']); //done


Route::middleware('auth.json:sanctum')->group(function () {
// profile
Route::put('users', [UserController::class, 'update']); //update nama DONE
Route::get('users', [UserController::class, 'profile']); //ngambil nama user DONE
Route::post('/logout', [AuthController::class, 'logout']); //done
// book
Route::get('/books/hero', [BookController::class, 'hero']); //1buku random hero DONE
Route::get('/books/popular', [BookController::class, 'popular']); //5 buku random DONE
Route::get('/books/rangking', [BookController::class, 'rangking']); //4 buku rangking tertinggi DONE
Route::get('/books/new', [BookController::class, 'new']); //4 buku new tertinggi DONE
Route::get('/books/recommend', [BookController::class, 'recommend']); //4 buku random DONE
Route::get('/books', [BookController::class, 'index']); //done
Route::get('/books/{id}', [BookController::class, 'show']); //done
Route::get('/books/{id}/borrow', [BookController::class, 'borrow']); //done

// borrowing
Route::post('borrowings/{id}', [BorrowingController::class, 'store']); //DONE
Route::get('borrowings', [BorrowingController::class, 'getBorrowingsByUser']); //where user_id == id(users) DONE
Route::get('borrowings/borrow', [BorrowingController::class, 'index2']); //where user_id == id(users) where status=borrowed
Route::get('borrowings/return', [BorrowingController::class, 'index2']); //where user_id == id(users) where status=returned
Route::get('borrowings/{id}', [BorrowingController::class, 'show']); 

// review
Route::get('reviews', [ReviewController::class, 'index']);
Route::post('reviews', [ReviewController::class, 'store']);
});
