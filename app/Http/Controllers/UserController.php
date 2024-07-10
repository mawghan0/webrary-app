<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Validasi email
        if ($validator->fails() && $validator->errors()->has('email')) {
            return response()->json(['error' => $validator->errors()->first('email')], 400);
        }

        // Validasi password
        if ($validator->fails() && $validator->errors()->has('password')) {
            return response()->json(['error' => $validator->errors()->first('password')], 400);
        }

        // Create user jika validasi berhasil
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Pastikan untuk menggunakan enkripsi password
        ]);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function update(Request $request)
    {
        // Dapatkan pengguna yang terautentikasi
        $user = Auth::user();

        // Pastikan pengguna ditemukan
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Update nama pengguna
        $user = User::where('id', $user->id)->update(['name' => $request->name]);
        // $user->name = $request->name;
        // $user->save();

        return response()->json(['message' => 'Name updated successfully', 'user' => $request->name], 200);
    }
    public function profile()
    {
        // Dapatkan pengguna yang terautentikasi
        $user = Auth::user();

        // Pastikan pengguna ditemukan
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        return response()->json(['message' => 'Name', 'user' => $user->name], 200);
    }
}
