<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\PaymentController;

// Route untuk tes autentikasi dengan Laravel Sanctum menggunakan token
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk registrasi
Route::post('/register', [AuthController::class, 'register']);

// Route untuk login dan mendapatkan token
Route::post('/login', [AuthController::class, 'login']);

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route untuk mendapatkan daftar kategori (public route)
Route::get('/categories', [CategoryController::class, 'index']);

// Route untuk mendapatkan produk (public route)
Route::get('/products', [ProductController::class, 'index']);

// Route kategori yang dilindungi autentikasi (hanya bisa diakses oleh pengguna yang sudah login dengan token)
Route::middleware('auth:sanctum')->get('/protected-categories', [CategoryController::class, 'index']);

Route::post('/midtrans/token', [PaymentController::class, 'getSnapToken']);
