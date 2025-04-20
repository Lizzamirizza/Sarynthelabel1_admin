<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'shipping_cost',
        'tax',
    ];

    /**
     * Relasi ke tabel orders
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke tabel products
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Hitung subtotal per baris detail
     */
    public function getSubtotalAttribute(): float
    {
        return ($this->price * $this->quantity) + $this->shipping_cost + $this->tax;
    }
}
