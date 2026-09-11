<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('home')
                ->withFragment('menu')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('customer.checkout', compact(
            'cart',
            'total'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);


        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('home')
                ->withFragment('menu')
                ->with('error', 'Keranjang masih kosong.');
        }


        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }


        $order = DB::transaction(function () use (
            $request,
            $cart,
            $total
        ) {

            /*
            |--------------------------------------------------------------------------
            | Buat Order
            |--------------------------------------------------------------------------
            */

            $order = Order::create([
                'user_id' => auth()->id(),

                'order_code' => 'BYA-' . strtoupper(
                    Str::random(8)
                ),

                'customer_name' => auth()->user()->name,

                'phone' => $request->phone,

                'address' => $request->address,

                'notes' => $request->notes,

                'total_amount' => $total,

                'payment_status' => 'pending',

                'order_status' => 'pending',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Simpan Item Pesanan
            |--------------------------------------------------------------------------
            */

            foreach ($cart as $item) {

                $order->items()->create([
                    'product_id' => $item['id'],

                    'product_name' => $item['name'],

                    'price' => $item['price'],

                    'quantity' => $item['quantity'],

                    'subtotal' =>
                        $item['price'] * $item['quantity'],
                ]);

            }


            /*
            |--------------------------------------------------------------------------
            | Buat Payment
            |--------------------------------------------------------------------------
            */

            $order->payment()->create([
                'payment_method' => 'qris',

                'amount' => $total,

                'status' => 'pending',
            ]);


            return $order;
        });


        /*
        |--------------------------------------------------------------------------
        | Kosongkan Keranjang
        |--------------------------------------------------------------------------
        */

        session()->forget('cart');


        /*
        |--------------------------------------------------------------------------
        | Arahkan ke Halaman Pembayaran
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('payment.show', $order)
            ->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }
}