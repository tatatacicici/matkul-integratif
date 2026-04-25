<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// --- ENDPOINT AUTENTIKASI ---
Route::post('/login', [AuthController::class, 'login']);

// --- ENDPOINT PUBLIK (Tidak perlu token/login) ---
// Hanya mengizinkan method index (melihat semua) dan show (melihat detail)
// Menambahkan throttle:60,1 (Maksimal 60 request per menit untuk tamu/IP anonim)
Route::middleware('throttle:60,1')->group(function () {
    Route::apiResource('posts', PostController::class)->only(['index', 'show']);
    Route::apiResource('comments', CommentController::class)->only(['index', 'show']);
});

// --- ENDPOINT PRIVAT (Wajib menyertakan Token Sanctum) ---
// Mengizinkan method store (buat), update (edit), dan destroy (hapus)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class)->except(['index', 'show']);
    Route::apiResource('comments', CommentController::class)->except(['index', 'show']);
    

    // Endpoint bawaan untuk cek user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});  