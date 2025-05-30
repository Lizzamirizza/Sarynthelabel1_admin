<?php
namespace App\Services;

use Midtrans\Snap;
use Midtrans\Config;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // ubah true jika production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($order)
    {
        return Snap::createTransaction([
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
        ]);
    }
}
