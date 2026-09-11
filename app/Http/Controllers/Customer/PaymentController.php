<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        // Pastikan pesanan milik customer yang sedang login
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Ambil payment yang terkait dengan order
        $payment = $order->payment;

        if (!$payment) {
            abort(404, 'Data pembayaran tidak ditemukan.');
        }

        return view('customer.payment', compact(
            'order',
            'payment'
        ));
    }
}