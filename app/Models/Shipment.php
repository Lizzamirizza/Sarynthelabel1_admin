<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'courier',
        'tracking_number',
        'status',
        'address',
        'estimated_delivery',
        'shipped_at',
        'delivered_at',
    ];

    /**
     * Relasi ke order
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
