<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DummyAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada header Authorization
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json([
                'message' => 'Token tidak ada, akses ditolak'
            ], 401);
        }

        // Format token dummy harus "Bearer <token>"
        if (!str_starts_with($token, 'Bearer ')) {
            return response()->json([
                'message' => 'Format token salah'
            ], 401);
        }

        // Ambil token aslinya
        $tokenValue = trim(str_replace('Bearer', '', $token));

        // Contoh token valid (seharusnya berupa base64 dari email)
        // Kamu bebas menyesuaikan pengecekan token
        if ($tokenValue == '') {
            return response()->json([
                'message' => 'Token tidak valid'
            ], 401);
        }

        // Jika token lolos, lanjutkan request
        return $next($request);
    }
}
