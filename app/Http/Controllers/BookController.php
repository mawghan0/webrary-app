<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function hero()
    {
        // Ambil satu buku secara acak
        $book = Book::inRandomOrder()->first();

        // Kembalikan response JSON dengan kolom yang diminta
        return response()->json([
            'id' => $book->id,
            'title' => $book->title,
            'genre' => $book->genre,
            'description' => $book->description,
            'cover_image' => $book->cover_image,
        ]);
    }

    public function popular()
    {
        // Ambil enam buku secara acak
        $books = Book::inRandomOrder()->limit(6)->get();

        // Format data yang akan dikembalikan dalam response JSON
        $formattedBooks = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'genre' => $book->genre,
                'cover_image' => $book->cover_image,
            ];
        });

        // Kembalikan response JSON dengan data buku yang diminta
        return response()->json($formattedBooks);
    }

    public function rangking()
    {
        // Ambil empat buku dengan rating tertinggi
        $books = Book::orderBy('rating', 'desc')->limit(4)->get();

        // Format data yang akan dikembalikan dalam response JSON
        $formattedBooks = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'genre' => $book->genre,
                'rating' => $book->rating,
                'cover_image' => $book->cover_image,
            ];
        });

        // Kembalikan response JSON dengan data buku yang diminta
        return response()->json($formattedBooks);
    }

    public function new()
    {
        // Ambil empat buku dengan year_published terbaru
        $books = Book::orderBy('year_published', 'desc')->limit(4)->get();

        // Format data yang akan dikembalikan dalam response JSON
        $formattedBooks = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'genre' => $book->genre,
                'rating' => $book->rating,
                'cover_image' => $book->cover_image,
            ];
        });

        // Kembalikan response JSON dengan data buku yang diminta
        return response()->json($formattedBooks);
    }

    public function recommend()
    {
        // Ambil empat buku secara acak
        $books = Book::inRandomOrder()->limit(4)->get();
    
        // Format data yang akan dikembalikan dalam response JSON
        $formattedBooks = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'genre' => $book->genre,
                'rating' => $book->rating,
                'cover_image' => $book->cover_image,
            ];
        });
    
        // Kembalikan response JSON dengan data buku yang diminta
        return response()->json($formattedBooks);
    }

    public function index()
    {
        $books = Book::all()->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'genre' => $book->genre,
                'cover_image' => $book->cover_image,
            ];
        });

        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }
}
