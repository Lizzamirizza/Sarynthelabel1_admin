<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\OrderController;

// Route untuk tes autentikasi dengan Laravel Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
});


Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Route untuk registrasi
Route::post('/register', [AuthController::class, 'register']);

// Route untuk login
Route::post('/login', [AuthController::class, 'login']);

// Route untuk mendapatkan daftar kategori (public route)
Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);

Route::put('/products', [ProductController::class, 'index']);

// Route kategori yang dilindungi autentikasi (hanya bisa diakses oleh pengguna yang sudah login)
Route::middleware('auth:sanctum')->get('/protected-categories', [CategoryController::class, 'index']);

// routes/api.php
Route::get('/products/category/{categoryId}', [ProductController::class, 'getRelatedProducts']);

Route::middleware('auth:sanctum')->post('/midtrans/token', [OrderController::class, 'getSnapToken']);
Route::post('/midtrans/callback', [OrderController::class, 'handleCallback']);

