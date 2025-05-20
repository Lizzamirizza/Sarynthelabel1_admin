<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Mengambil semua produk yang tersedia beserta kategori, admin, dan gambar dari storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Pagination settings
        $perPage = $request->input('per_page', 8); // Default per_page is 8, can be set dynamically via query string

        // Retrieve products with related category, admin, and image URL (if available)
        $products = Product::with(['category', 'admin'])
            ->where('stock', '>', 0) // Only get products with available stock
            ->paginate($perPage); // Paginate the results

        // Modify products to add full image URL (if needed)
        $products->getCollection()->transform(function ($product) {
            // Check if image exists and prepend the asset URL
            $product->image = $product->image ? asset('storage/' . $product->image) : null; // Make sure to handle null image
            return $product;
        });

        // Return products with pagination metadata
        return response()->json($products);
    }
} 