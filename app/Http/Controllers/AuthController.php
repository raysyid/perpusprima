<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Dummy user sebagai contoh database
    protected $userDummy = [
        [
            'id' => 1,
            'nama' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'password' => '123456' // password tidak di-hash karena dummy
        ],
        [
            'id' => 2,
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => 'password'
        ],
    ];

    // REGISTER dummy (tambah user)
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $newUser = [
            'id' => count($this->userDummy) + 1,
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => $validated['password']  // tidak di-hash karena dummy
        ];

        $this->userDummy[] = $newUser;

        return response()->json([
            'message' => 'Registrasi berhasil',
            'user' => $newUser
        ], 201);
    }

    // LOGIN dummy
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = collect($this->userDummy)->firstWhere('email', $validated['email']);

        if (!$user) {
            return response()->json(['message' => 'Email tidak terdaftar'], 404);
        }

        // Cek password (karena dummy, tidak hash)
        if ($user['password'] !== $validated['password']) {
            return response()->json(['message' => 'Password salah'], 401);
        }

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token_dummy' => base64_encode($user['email']) // hanya dummy token
        ]);
    }
}
