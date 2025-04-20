<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Menambahkan 'image' ke dalam $fillable agar bisa diisi dengan mudah
    protected $fillable = ['name', 'image', 'admin_id'];

    /**
     * Relasi ke admin (kategori dibuat oleh admin)
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Relasi ke produk (1 kategori punya banyak produk)
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
