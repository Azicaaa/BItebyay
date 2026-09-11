@extends('layouts.customer')

@section('content')

<section class="bg-pink-50 min-h-screen py-4 sm:py-6">

    <div class="max-w-5xl mx-auto px-5 sm:px-6 lg:px-8">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="text-center mb-5">

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                Pembayaran QRIS
            </h1>

            <p class="mt-1.5 text-sm text-gray-500">
                Selesaikan pembayaran untuk memproses pesanan Anda.
            </p>

        </div>


        {{-- =====================================================
            PAYMENT CONTAINER
        ====================================================== --}}

        <div
            class="bg-white
                   rounded-2xl
                   border border-pink-100
                   shadow-sm
                   overflow-hidden
                   relative"
        >

            {{-- Sekat tengah --}}
            <div
                class="absolute
                       top-0
                       bottom-0
                       left-1/2
                       w-px
                       bg-gray-300"
            ></div>


            {{-- =================================================
                TWO COLUMNS
            ================================================== --}}

            <div class="grid grid-cols-2">


                {{-- =================================================
                    LEFT : QRIS
                ================================================== --}}

                <div class="p-6 sm:p-8">

                    <div class="text-center">

                        {{-- Total --}}

                        <p class="text-sm text-gray-500">
                            Total Pembayaran
                        </p>

                        <p class="mt-1 text-3xl font-bold text-pink-600">
                            Rp{{ number_format($payment->amount, 0, ',', '.') }}
                        </p>


                        {{-- QRIS --}}

                        <div
                            class="mt-5
                                mx-auto
                                w-56 h-56
                                rounded-xl
                                border border-gray-200
                                bg-white
                                p-3
                                flex items-center justify-center"
                        >
                            <img
                                src="{{ asset('img/qris-bitebyay.jpeg') }}"
                                alt="QRIS BitebyAy"
                                class="w-full h-full object-contain"
                            >
                        </div>

                        <p class="mt-3 text-sm font-semibold text-gray-700">
                            Scan QRIS BitebyAy
                        </p>


                        {{-- Cara Pembayaran --}}

                        <div class="mt-5 text-left">

                            <h3 class="text-sm font-bold text-gray-800">
                                Cara Pembayaran
                            </h3>

                            <div
                                class="mt-2
                                       space-y-1.5
                                       text-sm
                                       text-gray-500"
                            >

                                <div class="flex gap-3">

                                    <span class="font-bold text-pink-600">
                                        1
                                    </span>

                                    <span>
                                        Buka aplikasi pembayaran yang
                                        mendukung QRIS.
                                    </span>

                                </div>


                                <div class="flex gap-3">

                                    <span class="font-bold text-pink-600">
                                        2
                                    </span>

                                    <span>
                                        Scan QRIS BitebyAy.
                                    </span>

                                </div>


                                <div class="flex gap-3">

                                    <span class="font-bold text-pink-600">
                                        3
                                    </span>

                                    <span>
                                        Bayar sesuai total pesanan.
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    RIGHT : DETAIL PESANAN
                ================================================== --}}

                <div class="p-6 sm:p-8">

                    <h2
                        class="text-xl
                               font-bold
                               text-gray-800"
                    >
                        Detail Pesanan
                    </h2>


                    {{-- Nomor Pesanan --}}

                    <div class="mt-4">

                        <p class="text-xs text-gray-500">
                            Nomor Pesanan
                        </p>

                        <p
                            class="mt-1
                                   text-sm
                                   font-bold
                                   text-gray-800"
                        >
                            {{ $order->order_code }}
                        </p>

                    </div>


                    {{-- Produk --}}

                    <div
                        class="mt-5
                               divide-y
                               divide-gray-100"
                    >

                        @foreach ($order->items as $item)

                            <div
                                class="py-3
                                       first:pt-0
                                       last:pb-0"
                            >

                                <div
                                    class="flex
                                           justify-between
                                           gap-4"
                                >

                                    <div class="min-w-0">

                                        <p
                                            class="text-sm
                                                   font-semibold
                                                   text-gray-800"
                                        >
                                            {{ $item->product_name }}
                                        </p>

                                        <p
                                            class="mt-1
                                                   text-xs
                                                   text-gray-500"
                                        >
                                            {{ $item->quantity }}
                                            ×
                                            Rp{{ number_format($item->price, 0, ',', '.') }}
                                        </p>

                                    </div>


                                    <p
                                        class="text-sm
                                               font-semibold
                                               text-gray-800
                                               whitespace-nowrap"
                                    >
                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    {{-- Total --}}

                    <div
                        class="mt-4
                               pt-4
                               border-t
                               border-gray-200"
                    >

                        <div
                            class="flex
                                   items-center
                                   justify-between"
                        >

                            <span class="font-semibold text-gray-800">
                                Total
                            </span>

                            <span
                                class="text-xl
                                       font-bold
                                       text-pink-600"
                            >
                                Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                            </span>

                        </div>

                    </div>


                    {{-- Status --}}

                    <div
                        class="mt-4
                               rounded-xl
                               bg-yellow-50
                               border
                               border-yellow-200
                               px-4 py-3"
                    >

                        <p
                            class="text-sm
                                   font-semibold
                                   text-gray-800"
                        >
                            Menunggu Pembayaran
                        </p>

                        <p
                            class="mt-1
                                   text-xs
                                   text-gray-500
                                   leading-relaxed"
                        >
                            Setelah pembayaran dilakukan,
                            admin akan memeriksa dan memverifikasi
                            pembayaran Anda.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            BACK BUTTON
        ====================================================== --}}

        <div class="mt-4 text-center">

            <a
                Route [orders.index] not defined.

Expand vendor frames
2 vendor frames
C:\laragon\www\bitebyay\resources\views\customer\payment.blade
.php
 
: 362
require
52 vendor frames
C:\laragon\www\bitebyay\public\index
.php
 
: 51
require_once
1 vendor frame
C:\laragon\www\bitebyay\resources\views\customer\payment.blade
.php
 
: 362

































                </div>



            </div>



        </div>





        {{-- =====================================================

            BACK BUTTON

        ====================================================== --}}



        <div class="mt-4 text-center">



            <a

                href="{{ url('/pesanan-saya') }}"
                class="inline-flex
                    items-center
                    justify-center
                    px-5 py-2.5
                    border
                    border-pink-200
                    text-pink-600
                    hover:bg-white
                    font-semibold
                    rounded-full
                    transition"
            >
                ← Kembali ke Pesanan Saya
            </a>

        </div>

    </div>

</section>

@endsection