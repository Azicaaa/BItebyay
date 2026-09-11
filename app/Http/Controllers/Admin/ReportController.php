<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan penjualan.
     */
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Pesanan yang pembayarannya sudah dikonfirmasi
        |--------------------------------------------------------------------------
        */

        $paidOrders = Order::where('payment_status', 'paid');


        /*
        |--------------------------------------------------------------------------
        | Ringkasan
        |--------------------------------------------------------------------------
        */

        $totalSales = (clone $paidOrders)->sum('total_amount');

        $totalOrders = (clone $paidOrders)->count();

        $completedOrders = (clone $paidOrders)
            ->where('order_status', 'completed')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Total produk terjual
        |--------------------------------------------------------------------------
        */

        $productsSold = OrderItem::whereHas('order', function ($query) {
            $query->where('payment_status', 'paid');
        })->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | Produk terlaris
        |--------------------------------------------------------------------------
        */

        $topProducts = OrderItem::query()
            ->selectRaw('
                product_name,
                SUM(quantity) as total_quantity,
                SUM(subtotal) as total_revenue
            ')
            ->whereHas('order', function ($query) {
                $query->where('payment_status', 'paid');
            })
            ->groupBy('product_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Transaksi terbaru
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with('payment')
            ->where('payment_status', 'paid')
            ->latest()
            ->limit(10)
            ->get();


        return view(
            'admin.reports.index',
            compact(
                'totalSales',
                'totalOrders',
                'completedOrders',
                'productsSold',
                'topProducts',
                'recentOrders'
            )
        );
    }
}