<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'items',
            'payment',
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        // Pastikan customer hanya bisa melihat pesanannya sendiri
        abort_unless(
            $order->user_id === auth()->id(),
            403
        );

        $order->load([
            'items.product',
            'payment',
        ]);

        return view('customer.orders.show', compact('order'));
    }
}