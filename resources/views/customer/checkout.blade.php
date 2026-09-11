@extends('layouts.customer')

@section('content')

<section class="bg-pink-50 min-h-screen py-8 sm:py-10">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}

        <div class="mb-7">

            @if ($errors->any())

                <div
                    class="mb-5 rounded-xl
                           border border-red-200
                           bg-red-50
                           px-4 py-3"
                >

                    <ul class="text-sm text-red-600 space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                Checkout
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Periksa kembali pesanan sebelum melanjutkan pembayaran.
            </p>

        </div>


        {{-- =================================================
            CHECKOUT FORM
        ================================================== --}}

        <form
            action="{{ route('checkout.store') }}"
            method="POST"
        >

            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-7">


                {{-- =================================================
                    CUSTOMER INFORMATION
                ================================================== --}}

                <div class="lg:col-span-2">

                    <div
                        class="bg-white rounded-2xl
                               border border-pink-100
                               shadow-sm p-5 sm:p-6"
                    >

                        <h2 class="text-lg font-bold text-gray-800">
                            Data Pemesan
                        </h2>


                        <div class="mt-5 space-y-5">

                            {{-- Name --}}

                            <div>

                                <label
                                    for="customer_name"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Nama
                                </label>

                                <input
                                    type="text"
                                    id="customer_name"
                                    value="{{ auth()->user()->name }}"
                                    readonly
                                    class="w-full rounded-xl
                                           border-gray-200
                                           bg-gray-50
                                           text-gray-700
                                           focus:ring-0"
                                >

                            </div>


                            {{-- Phone --}}

                            <div>

                                <label
                                    for="phone"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    No. WhatsApp
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                    placeholder="Masukkan nomor WhatsApp"
                                    required
                                    class="w-full rounded-xl
                                           border-gray-200
                                           focus:border-pink-500
                                           focus:ring-pink-500"
                                >

                            </div>


                            {{-- Address --}}

                            <div>

                                <label
                                    for="address"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Alamat
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    rows="3"
                                    placeholder="Masukkan alamat pengantaran"
                                    required
                                    class="w-full rounded-xl
                                           border-gray-200
                                           focus:border-pink-500
                                           focus:ring-pink-500"
                                >{{ old('address', auth()->user()->address ?? '') }}</textarea>

                            </div>


                            {{-- Notes --}}

                            <div>

                                <label
                                    for="notes"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Catatan
                                    <span class="text-gray-400 font-normal">
                                        (opsional)
                                    </span>
                                </label>

                                <textarea
                                    id="notes"
                                    name="notes"
                                    rows="2"
                                    placeholder="Contoh: tanpa lilin, tambahan kartu ucapan, dll."
                                    class="w-full rounded-xl
                                           border-gray-200
                                           focus:border-pink-500
                                           focus:ring-pink-500"
                                >{{ old('notes') }}</textarea>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        ORDER ITEMS
                    ================================================== --}}

                    <div
                        class="mt-5
                               bg-white rounded-2xl
                               border border-pink-100
                               shadow-sm p-5 sm:p-6"
                    >

                        <h2 class="text-lg font-bold text-gray-800">
                            Pesanan Anda
                        </h2>


                        <div class="mt-5 divide-y divide-gray-100">

                            @foreach ($cart as $item)

                                <div
                                    class="py-4 first:pt-0 last:pb-0
                                           flex items-center gap-4"
                                >

                                    {{-- Product Image --}}

                                    <div
                                        class="w-16 h-16
                                               rounded-xl
                                               overflow-hidden
                                               bg-gray-100
                                               flex-shrink-0"
                                    >

                                        <img
                                            src="{{ asset('img/' . $item['image']) }}"
                                            alt="{{ $item['name'] }}"
                                            class="w-full h-full object-cover"
                                        >

                                    </div>


                                    {{-- Product Info --}}

                                    <div class="flex-1 min-w-0">

                                        <h3
                                            class="font-semibold
                                                   text-sm text-gray-800"
                                        >
                                            {{ $item['name'] }}
                                        </h3>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $item['quantity'] }} ×
                                            Rp{{ number_format($item['price'], 0, ',', '.') }}
                                        </p>

                                    </div>


                                    {{-- Subtotal --}}

                                    <p class="font-semibold text-sm text-gray-800">
                                        Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </p>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    SUMMARY
                ================================================== --}}

                <div>

                    <div
                        class="bg-white rounded-2xl
                               border border-pink-100
                               shadow-sm p-5 sm:p-6
                               lg:sticky lg:top-24"
                    >

                        <h2 class="text-lg font-bold text-gray-800">
                            Ringkasan Pesanan
                        </h2>


                        <div class="mt-5 space-y-3 text-sm">

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Jumlah item
                                </span>

                                <span class="font-medium text-gray-800">
                                    {{ collect($cart)->sum('quantity') }}
                                </span>

                            </div>


                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Subtotal
                                </span>

                                <span class="font-semibold text-gray-800">
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>


                        <div class="my-5 border-t border-gray-100"></div>


                        {{-- Total --}}

                        <div class="flex justify-between items-center">

                            <span class="font-semibold text-gray-800">
                                Total
                            </span>

                            <span class="text-xl font-bold text-pink-600">
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </span>

                        </div>


                        {{-- Payment --}}

                        <div class="mt-6">

                            <p class="text-sm font-semibold text-gray-800">
                                Metode Pembayaran
                            </p>

                            <div
                                class="mt-3
                                       rounded-xl
                                       border border-pink-200
                                       bg-pink-50
                                       p-4"
                            >

                                <div class="flex items-center gap-3">

                                    <div
                                        class="w-10 h-10
                                               rounded-lg
                                               bg-white
                                               flex items-center
                                               justify-center
                                               text-pink-600
                                               font-bold"
                                    >
                                        QR
                                    </div>

                                    <div>

                                        <p class="font-semibold text-gray-800">
                                            QRIS
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            Pembayaran melalui QRIS
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Create Order --}}

                        <button
                            type="submit"
                            class="mt-6 w-full
                                   py-3.5
                                   bg-pink-600
                                   hover:bg-pink-700
                                   text-white
                                   font-semibold
                                   rounded-full
                                   transition duration-300"
                        >
                            Buat Pesanan & Bayar
                        </button>


                        {{-- Back to Cart --}}

                        <a
                            href="{{ route('cart.index') }}"
                            class="mt-3 w-full
                                   inline-flex
                                   items-center
                                   justify-center
                                   py-3
                                   border border-pink-200
                                   text-pink-600
                                   hover:bg-pink-50
                                   font-semibold
                                   rounded-full
                                   transition duration-300"
                        >
                            Kembali ke Keranjang
                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</section>

@endsection