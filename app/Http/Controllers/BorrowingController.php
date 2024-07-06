<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function getBorrowingDetails($id)
    {
        $borrowing = Borrowing::where('borrowings.id', $id)
            ->join('books', 'borrowings.book_id', '=', 'books.id')
            ->join('users', 'borrowings.user_id', '=', 'users.id')
            ->select(
                'borrowings.book_id',
                'books.publisher',
                'users.name as user_name',
                'books.title',
                'books.author',
                'books.cover_image',
                'borrowings.return_date'
            )
            ->first();

        if ($borrowing) {
            return response()->json($borrowing);
        } else {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }
    }

    public function store($id)
    {
        $user = Auth::user();

        // Mengatur return_date ke satu bulan setelah tanggal saat ini
        $return_date = Carbon::now()->addMonth();

        // Membuat data peminjaman baru
        $borrowing = new Borrowing;
        $borrowing->user_id = $user->id;
        $borrowing->book_id = $id;
        $borrowing->borrow_date = Carbon::now();
        $borrowing->return_date = $return_date;
        $borrowing->status = 'borrowed';
        $borrowing->save();

        return response()->json([
            'message' => 'Book borrowed successfully',
            'data' => $borrowing
        ], 201);
    }

    public function getBorrowedByUser()
    {
        $user = Auth::user();

        $borrowings = Borrowing::where('user_id', $user->id)
            ->where('status', 'borrowed')
            ->join('books', 'borrowings.book_id', '=', 'books.id')
            ->select('borrowings.id', 'borrowings.book_id', 'books.title', 'books.genre', 'books.cover_image', 'borrowings.status', 'borrowings.return_date')
            ->get();

        return response()->json($borrowings);
    }

    public function getReturnedByUser()
    {
        $user = Auth::user();

        $borrowings = Borrowing::where('user_id', $user->id)
            ->where('status', 'returned')
            ->join('books', 'borrowings.book_id', '=', 'books.id')
            ->select('borrowings.id', 'borrowings.book_id', 'books.title', 'books.genre', 'books.cover_image', 'borrowings.status', 'borrowings.return_date')
            ->get();

        return response()->json($borrowings);
    }
    public function extendReturnDate($id)
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }

        $borrowing->return_date = Carbon::parse($borrowing->return_date)->addWeek();
        $borrowing->save();

        return response()->json([
            'message' => 'Return date extended successfully',
            'data' => $borrowing
        ]);
    }
}
