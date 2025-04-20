<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_status',
        'payment_date',
        'amount',
        'midtrans_transaction_id',
        'midtrans_status',
    ];

    /**
     * Relasi ke order
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
