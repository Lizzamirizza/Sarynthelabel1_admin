<?php

// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getSnapToken(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => $request->amount ?? 10000,
            ],
            'customer_details' => [
                'first_name' => 'Tasya',
                'email' => 'tasya@example.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['token' => $snapToken]);
    }
}
