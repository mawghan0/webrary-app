<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function getBorrowingsByUser()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Mengambil semua peminjaman berdasarkan ID pengguna
        $borrowings = Borrowing::where('user_id', $user->id)
            ->join('books', 'borrowings.book_id', '=', 'books.id')
            ->select('borrowings.id', 'borrowings.book_id', 'books.title', 'books.genre', 'books.cover_image', 'borrowings.status', 'borrowings.return_date')
            ->get();

        // Mengembalikan data peminjaman dalam bentuk JSON
        return response()->json($borrowings);
    }

    public function show($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        return response()->json($borrowing);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date',
            'status' => 'required|in:borrowed,returned',
        ]);

        $borrowing = Borrowing::create($request->all());

        return response()->json($borrowing, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date',
            'status' => 'required|in:borrowed,returned',
        ]);

        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update($request->all());

        return response()->json($borrowing, 200);
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();
        return response()->json(null, 204);
    }
}
