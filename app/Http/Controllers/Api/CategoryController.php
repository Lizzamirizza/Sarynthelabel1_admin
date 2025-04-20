<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Mengambil semua kategori beserta gambar dari storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Ambil semua kategori dari database dan maping setiap kategori
        // ke dalam array dengan 'name' dan 'image' (dari storage)
        $categories = Category::all()->map(function ($category) {
            return [
                'name'  => $category->name,  // Mengambil nama kategori
                'image' => asset('storage/' . $category->image)  // Membuat URL gambar yang disimpan di storage
            ];
        });

        // Mengembalikan response JSON berisi kategori
        return response()->json($categories);
    }
}
