<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::all();
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
