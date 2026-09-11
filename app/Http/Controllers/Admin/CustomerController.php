<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index(): View
    {
        $customers = User::query()
            ->where('role', 'customer')
            ->withCount('orders')
            ->latest()
            ->paginate(10);

        return view(
            'admin.customers.index',
            compact('customers')
        );
    }
}