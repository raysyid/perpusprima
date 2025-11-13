<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BooksController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

// CRUD lama
Route::post('/students', [StudentController::class, 'store']);
Route::get('/students', [StudentController::class, 'index']);
Route::delete('/students/{nim}', [StudentController::class, 'destroy']);
Route::put('/students/{nim}', [StudentController::class, 'update']);
Route::patch('/students/{nim}', [StudentController::class, 'update']);

// CRUD baru

Route::post('/books', [StudentController::class, 'store']);
Route::get('/books', [StudentController::class, 'index']);
Route::delete('/students/{nim}', [StudentController::class, 'destroy']);
Route::put('/students/{nim}', [StudentController::class, 'update']);
Route::patch('/students/{nim}', [StudentController::class, 'update']);

// JWT
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class,'login']);
Route::middleware(['dummy.jwt'])->group(function() {
Route::post('/logout', [AuthController::class,'logout']);
Route::get('/profile', [AuthController::class,'profile']);


});