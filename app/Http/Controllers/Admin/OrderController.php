<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'user',
            'payment',
        ])
        ->latest()
        ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        $order->load([
            'user',
            'items.product',
            'payment',
        ]);

        return view('admin.orders.show', compact('order'));
    }


    public function confirmPayment(Order $order): RedirectResponse
    {
        // Pastikan order memiliki payment
        if (!$order->payment) {
            return back()->with(
                'error',
                'Pesanan ini belum memiliki pembayaran.'
            );
        }

        // Jangan konfirmasi pembayaran yang sudah selesai
        if ($order->payment->status === 'paid') {
            return back()->with(
                'error',
                'Pembayaran pesanan ini sudah dikonfirmasi.'
            );
        }

        // Konfirmasi pembayaran
        $order->payment->update([
            'status' => 'paid',
            'paid_at' => now(),
            'verified_at' => now(),
        ]);

        // Ubah status pesanan menjadi sedang diproses
        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'processing',
        ]);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with(
                'success',
                'Pembayaran berhasil dikonfirmasi.'
            );
    }


    public function completeOrder(Order $order): RedirectResponse
    {
        // Pesanan hanya bisa diselesaikan
        // jika pembayarannya sudah dikonfirmasi
        if ($order->payment_status !== 'paid') {
            return back()->with(
                'error',
                'Pesanan belum memiliki pembayaran yang dikonfirmasi.'
            );
        }

        // Jangan selesaikan pesanan yang sudah selesai
        if ($order->order_status === 'completed') {
            return back()->with(
                'error',
                'Pesanan ini sudah diselesaikan.'
            );
        }

        // Selesaikan pesanan
        $order->update([
            'order_status' => 'completed',
        ]);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with(
                'success',
                'Pesanan berhasil diselesaikan.'
            );
    }
}