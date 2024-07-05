<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'year_published' => 'required|integer',
            'genre' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'year_published' => 'required|integer',
            'genre' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(null, 204);
    }
}
