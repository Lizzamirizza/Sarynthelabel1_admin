<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\MidtransService;

class OrderController extends Controller
{
    public function getSnapToken(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $midtrans = new MidtransService();
        $snap = $midtrans->createTransaction($order);

        return response()->json([
            'token' => $snap->token,
        ]);
    }
    public function handleCallback(Request $request)
    {
        $payload = json_decode(file_get_contents("php://input"));

        $transactionStatus = $payload->transaction_status;
        $orderId = $payload->order_id;

        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status order berdasarkan status Midtrans
        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                $order->status = 'paid';
                break;
            case 'pending':
                $order->status = 'pending';
                break;
            case 'deny':
            case 'cancel':
            case 'expire':
                $order->status = 'failed';
                break;
            default:
                $order->status = 'unknown';
        }

        $order->save();

        return response()->json(['message' => 'Callback processed']);
    }
}
