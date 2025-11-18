<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
 protected $bukuDummy = [
        [
            'id' => 1,
            'judul' => 'Belajar Laravel',
            'penulis' => 'John Doe',
            'tahun_terbit' => 2022
        ],
        [
            'id' => 2,
            'judul' => 'Pemrograman PHP untuk Pemula',
            'penulis' => 'Jane Smith',
            'tahun_terbit' => 2021
        ],
        [
            'id' => 3,
            'judul' => 'JavaScript Essentials',
            'penulis' => 'Ali Mustafa',
            'tahun_terbit' => 2023
        ],
    ];
 public function index()
    {
        return response()->json($this->bukuDummy);
    }

    // Menampilkan detail buku berdasarkan ID
    public function show($id)
    {
        $buku = collect($this->bukuDummy)->firstWhere('id', $id);

        
        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json($buku);
    }

}