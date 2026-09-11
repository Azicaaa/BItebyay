@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- =====================================================
        NOTIFICATION
    ====================================================== --}}

    @if (session('success'))

        <div
            class="mb-6
                   rounded-xl
                   border border-green-200
                   bg-green-50
                   px-4 py-3
                   text-sm
                   text-green-700"
        >
            {{ session('success') }}
        </div>

    @endif


    @if (session('error'))

        <div
            class="mb-6
                   rounded-xl
                   border border-red-200
                   bg-red-50
                   px-4 py-3
                   text-sm
                   text-red-700"
        >
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="mb-8">

        <div class="flex items-center gap-3">

            <a
                href="{{ route('admin.orders.index') }}"
                class="inline-flex items-center justify-center
                       w-10 h-10
                       rounded-full
                       border border-gray-200
                       bg-white
                       text-gray-600
                       hover:bg-pink-50
                       hover:text-pink-600
                       transition"
            >
                ←
            </a>

            <div>

                <p class="text-sm text-gray-500">
                    Pesanan
                </p>

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    Detail Pesanan
                </h1>

            </div>

        </div>

    </div>


    {{-- =====================================================
        ORDER INFORMATION
    ====================================================== --}}

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


        {{-- =================================================
            LEFT : DETAIL PESANAN
        ================================================== --}}

        <div class="lg:col-span-2">

            <div
                class="bg-white
                       rounded-2xl
                       border border-gray-200
                       shadow-sm
                       overflow-hidden"
            >

                {{-- =================================================
                    ORDER HEADER
                ================================================== --}}

                <div
                    class="px-6 py-5
                           border-b border-gray-100
                           flex items-center justify-between
                           gap-4"
                >

                    <div>

                        <p class="text-xs text-gray-500">
                            Nomor Pesanan
                        </p>

                        <p
                            class="mt-1
                                   text-lg
                                   font-bold
                                   text-gray-800"
                        >
                            {{ $order->order_code }}
                        </p>

                    </div>


                    {{-- =================================================
                        ORDER STATUS
                    ================================================== --}}

                    @php

                        $orderStatus = $order->order_status ?? 'pending';

                        $orderStatusLabel = match ($orderStatus) {
                            'pending'   => 'Menunggu Pembayaran',
                            'processing' => 'Sedang Diproses',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                            default     => ucfirst($orderStatus),
                        };

                    @endphp


                    <span
                        class="
                            inline-flex
                            items-center
                            px-3 py-1.5
                            rounded-full
                            text-xs
                            font-semibold

                            @if ($orderStatus === 'completed')
                                bg-green-100 text-green-700
                            @elseif ($orderStatus === 'processing')
                                bg-blue-100 text-blue-700
                            @elseif ($orderStatus === 'cancelled')
                                bg-red-100 text-red-700
                            @else
                                bg-gray-100 text-gray-600
                            @endif
                        "
                    >
                        {{ $orderStatusLabel }}
                    </span>

                </div>


                {{-- =================================================
                    CUSTOMER
                ================================================== --}}

                <div class="px-6 py-5 border-b border-gray-100">

                    <h2 class="text-base font-bold text-gray-800">
                        Informasi Customer
                    </h2>


                    <div
                        class="mt-4
                               grid
                               grid-cols-1
                               sm:grid-cols-2
                               gap-4"
                    >

                        {{-- Nama --}}

                        <div>

                            <p class="text-xs text-gray-500">
                                Nama
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-800">
                                {{ $order->customer_name }}
                            </p>

                        </div>


                        {{-- No HP --}}

                        <div>

                            <p class="text-xs text-gray-500">
                                No. HP
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-800">
                                {{ $order->phone }}
                            </p>

                        </div>


                        {{-- Alamat --}}

                        @if ($order->address)

                            <div class="sm:col-span-2">

                                <p class="text-xs text-gray-500">
                                    Alamat
                                </p>

                                <p class="mt-1 text-sm text-gray-700">
                                    {{ $order->address }}
                                </p>

                            </div>

                        @endif


                        {{-- Catatan --}}

                        @if ($order->notes)

                            <div class="sm:col-span-2">

                                <p class="text-xs text-gray-500">
                                    Catatan
                                </p>

                                <p class="mt-1 text-sm text-gray-700">
                                    {{ $order->notes }}
                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                    PRODUCTS
                ================================================== --}}

                <div class="px-6 py-5">

                    <h2 class="text-base font-bold text-gray-800">
                        Produk Pesanan
                    </h2>


                    <div class="mt-4 divide-y divide-gray-100">

                        @foreach ($order->items as $item)

                            <div
                                class="py-4
                                       first:pt-0
                                       last:pb-0
                                       flex
                                       items-center
                                       justify-between
                                       gap-5"
                            >

                                <div class="flex items-center gap-4 min-w-0">

                                    {{-- Product Image --}}

                                    @if ($item->product && $item->product->image)

                                        <div
                                            class="w-16 h-16
                                                   rounded-xl
                                                   overflow-hidden
                                                   bg-gray-100
                                                   flex-shrink-0"
                                        >

                                            <img
                                                src="{{ asset('img/' . $item->product->image) }}"
                                                alt="{{ $item->product_name }}"
                                                class="w-full h-full object-cover"
                                            >

                                        </div>

                                    @endif


                                    {{-- Product Info --}}

                                    <div class="min-w-0">

                                        <p
                                            class="font-semibold
                                                   text-sm
                                                   text-gray-800"
                                        >
                                            {{ $item->product_name }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">

                                            {{ $item->quantity }}

                                            ×

                                            Rp{{ number_format($item->price, 0, ',', '.') }}

                                        </p>

                                    </div>

                                </div>


                                {{-- Subtotal --}}

                                <p
                                    class="text-sm
                                           font-bold
                                           text-gray-800
                                           whitespace-nowrap"
                                >
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            RIGHT : PAYMENT
        ================================================== --}}

        <div>

            <div
                class="bg-white
                       rounded-2xl
                       border border-gray-200
                       shadow-sm
                       p-6
                       lg:sticky
                       lg:top-28"
            >

                <h2 class="text-lg font-bold text-gray-800">
                    Pembayaran
                </h2>


                {{-- =================================================
                    PAYMENT INFORMATION
                ================================================== --}}

                @php

                    $paymentStatus = $order->payment?->status ?? 'pending';

                    $paymentStatusLabel = match ($paymentStatus) {
                        'pending'  => 'Menunggu',
                        'paid'     => 'Dikonfirmasi',
                        'rejected' => 'Ditolak',
                        default    => ucfirst($paymentStatus),
                    };

                @endphp


                <div class="mt-5 space-y-4">

                    {{-- Method --}}

                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Metode
                        </span>

                        <span
                            class="text-sm
                                   font-semibold
                                   text-gray-800
                                   uppercase"
                        >
                            {{ $order->payment?->payment_method ?? '-' }}
                        </span>

                    </div>


                    {{-- Amount --}}

                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Jumlah
                        </span>

                        <span class="text-sm font-semibold text-gray-800">

                            Rp{{ number_format(
                                $order->payment?->amount ?? $order->total_amount,
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>


                    {{-- Payment Status --}}

                    <div class="flex justify-between items-center gap-4">

                        <span class="text-sm text-gray-500">
                            Status
                        </span>


                        <span
                            class="
                                inline-flex
                                items-center
                                px-3 py-1
                                rounded-full
                                text-xs
                                font-semibold

                                @if ($paymentStatus === 'paid')
                                    bg-green-100 text-green-700
                                @elseif ($paymentStatus === 'rejected')
                                    bg-red-100 text-red-700
                                @else
                                    bg-yellow-100 text-yellow-700
                                @endif
                            "
                        >
                            {{ $paymentStatusLabel }}
                        </span>

                    </div>

                </div>


                {{-- =================================================
                    DIVIDER
                ================================================== --}}

                <div class="my-6 border-t border-gray-100"></div>


                {{-- =================================================
                    TOTAL
                ================================================== --}}

                <div class="flex items-center justify-between">

                    <span class="font-semibold text-gray-800">
                        Total Pesanan
                    </span>

                    <span class="text-xl font-bold text-pink-600">

                        Rp{{ number_format(
                            $order->total_amount,
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                {{-- =================================================
                    PAYMENT ACTION
                ================================================== --}}

                @if ($paymentStatus === 'pending')

                    {{-- =================================================
                        CONFIRM PAYMENT
                    ================================================== --}}

                    <form
                        action="{{ route('admin.orders.confirm-payment', $order) }}"
                        method="POST"
                        class="mt-6"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="
                                w-full
                                inline-flex
                                items-center
                                justify-center
                                py-3.5
                                px-5
                                rounded-xl
                                bg-pink-600
                                hover:bg-pink-700
                                text-white
                                font-semibold
                                transition
                                duration-200
                            "
                        >
                            Konfirmasi Pembayaran
                        </button>

                    </form>


                    {{-- Pending Information --}}

                    <div
                        class="
                            mt-4
                            rounded-xl
                            border border-yellow-200
                            bg-yellow-50
                            px-4 py-4
                        "
                    >

                        <p class="text-sm font-semibold text-gray-800">
                            Menunggu Pembayaran
                        </p>

                        <p class="mt-1 text-xs text-gray-500 leading-relaxed">
                            Pastikan transaksi QRIS sudah masuk ke akun
                            merchant sebelum mengonfirmasi pembayaran.
                        </p>

                    </div>


                @elseif ($paymentStatus === 'paid')

                    {{-- =================================================
                        PAYMENT VERIFIED
                    ================================================== --}}

                    <div
                        class="
                            mt-6
                            rounded-xl
                            border border-green-200
                            bg-green-50
                            px-4 py-4
                        "
                    >

                        <p class="text-sm font-semibold text-green-700">
                            Pembayaran Terverifikasi
                        </p>

                        <p class="mt-1 text-xs text-gray-500 leading-relaxed">

                            Pembayaran telah diterima.

                            @if ($orderStatus === 'processing')
                                Pesanan siap diproses.
                            @elseif ($orderStatus === 'completed')
                                Pesanan telah selesai.
                            @endif

                        </p>

                    </div>


                    {{-- =================================================
                        COMPLETE ORDER
                    ================================================== --}}

                    @if ($orderStatus === 'processing')

                        <form
                            action="{{ route('admin.orders.complete', $order) }}"
                            method="POST"
                            class="mt-4"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="
                                    w-full
                                    inline-flex
                                    items-center
                                    justify-center
                                    py-3.5
                                    px-5
                                    rounded-xl
                                    bg-green-600
                                    hover:bg-green-700
                                    text-white
                                    font-semibold
                                    transition
                                    duration-200
                                "
                            >
                                Tandai Pesanan Selesai
                            </button>

                        </form>

                    @elseif ($orderStatus === 'completed')

                        {{-- =================================================
                            ORDER COMPLETED
                        ================================================== --}}

                        <div
                            class="
                                mt-4
                                rounded-xl
                                border border-green-200
                                bg-green-50
                                px-4 py-4
                            "
                        >

                            <p class="text-sm font-semibold text-green-700">
                                Pesanan Selesai
                            </p>

                            <p class="mt-1 text-xs text-gray-500 leading-relaxed">
                                Pesanan ini telah selesai diproses.
                            </p>

                        </div>

                    @endif


                @elseif ($paymentStatus === 'rejected')

                    {{-- =================================================
                        REJECTED
                    ================================================== --}}

                    <div
                        class="
                            mt-6
                            rounded-xl
                            border border-red-200
                            bg-red-50
                            px-4 py-4
                        "
                    >

                        <p class="text-sm font-semibold text-red-700">
                            Pembayaran Ditolak
                        </p>

                        <p class="mt-1 text-xs text-gray-500 leading-relaxed">
                            Pembayaran pesanan ini ditolak.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection