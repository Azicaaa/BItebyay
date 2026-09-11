<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();

        $pendingPayments = Order::where('payment_status', 'pending')
            ->count();

        $processingOrders = Order::where('order_status', 'processing')
            ->count();

        $completedOrders = Order::where('order_status', 'completed')
            ->count();

        $recentOrders = Order::with([
            'user',
            'payment',
        ])
        ->latest()
        ->take(5)
        ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingPayments',
            'processingOrders',
            'completedOrders',
            'recentOrders'
        ));
    }
}