@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="mb-8">

        <p class="text-sm font-medium text-pink-600">
            Ringkasan Bisnis
        </p>

        <div
            class="
                mt-1
                flex
                flex-col
                sm:flex-row
                sm:items-end
                sm:justify-between
                gap-4
            "
        >

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Laporan
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Ringkasan penjualan dan aktivitas BitebyAy.
                </p>

            </div>

        </div>

    </div>


    {{-- =====================================================
        SUMMARY CARDS
    ====================================================== --}}

    <div
        class="
            grid
            grid-cols-1
            sm:grid-cols-2
            xl:grid-cols-4
            gap-5
            mb-8
        "
    >

        {{-- Total Penjualan --}}

        <div
            class="
                bg-white
                rounded-2xl
                border border-gray-200
                shadow-sm
                p-6
            "
        >

            <p class="text-sm text-gray-500">
                Total Penjualan
            </p>

            <p class="mt-2 text-2xl font-bold text-pink-600">
                Rp{{ number_format($totalSales, 0, ',', '.') }}
            </p>

            <p class="mt-2 text-xs text-gray-400">
                Dari pembayaran yang telah dikonfirmasi
            </p>

        </div>


        {{-- Total Pesanan --}}

        <div
            class="
                bg-white
                rounded-2xl
                border border-gray-200
                shadow-sm
                p-6
            "
        >

            <p class="text-sm text-gray-500">
                Pesanan Dibayar
            </p>

            <p class="mt-2 text-2xl font-bold text-gray-800">
                {{ $totalOrders }}
            </p>

            <p class="mt-2 text-xs text-gray-400">
                Total transaksi dengan pembayaran valid
            </p>

        </div>


        {{-- Produk Terjual --}}

        <div
            class="
                bg-white
                rounded-2xl
                border border-gray-200
                shadow-sm
                p-6
            "
        >

            <p class="text-sm text-gray-500">
                Produk Terjual
            </p>

            <p class="mt-2 text-2xl font-bold text-gray-800">
                {{ $productsSold }}
            </p>

            <p class="mt-2 text-xs text-gray-400">
                Total item dari pesanan dibayar
            </p>

        </div>


        {{-- Pesanan Selesai --}}

        <div
            class="
                bg-white
                rounded-2xl
                border border-gray-200
                shadow-sm
                p-6
            "
        >

            <p class="text-sm text-gray-500">
                Pesanan Selesai
            </p>

            <p class="mt-2 text-2xl font-bold text-green-600">
                {{ $completedOrders }}
            </p>

            <p class="mt-2 text-xs text-gray-400">
                Pesanan yang sudah selesai
            </p>

        </div>

    </div>


    {{-- =====================================================
        CONTENT GRID
    ====================================================== --}}

    <div
        class="
            grid
            grid-cols-1
            lg:grid-cols-2
            gap-6
        "
    >

        {{-- =================================================
            PRODUK TERLARIS
        ================================================== --}}

        <div
            class="
                bg-white
                rounded-2xl
                border border-gray-200
                shadow-sm
                overflow-hidden
            "
        >

            <div
                class="
                    px-6
                    py-5
                    border-b border-gray-100
                "
            >

                <h2 class="text-lg font-bold text-gray-800">
                    Produk Terlaris
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Produk dengan jumlah penjualan terbanyak.
                </p>

            </div>


            <div class="divide-y divide-gray-100">

                @forelse ($topProducts as $index => $product)

                    <div
                        class="
                            px-6
                            py-4
                            flex
                            items-center
                            justify-between
                            gap-4
                        "
                    >

                        <div class="flex items-center gap-4 min-w-0">

                            <div
                                class="
                                    w-9
                                    h-9
                                    rounded-full
                                    bg-pink-50
                                    text-pink-600
                                    flex
                                    items-center
                                    justify-center
                                    font-bold
                                    text-sm
                                    flex-shrink-0
                                "
                            >
                                {{ $index + 1 }}
                            </div>

                            <div class="min-w-0">

                                <p
                                    class="
                                        text-sm
                                        font-semibold
                                        text-gray-800
                                        truncate
                                    "
                                >
                                    {{ $product->product_name }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $product->total_quantity }} produk terjual
                                </p>

                            </div>

                        </div>


                        <p
                            class="
                                text-sm
                                font-bold
                                text-gray-800
                                whitespace-nowrap
                            "
                        >
                            Rp{{ number_format(
                                $product->total_revenue,
                                0,
                                ',',
                                '.'
                            ) }}
                        </p>

                    </div>

                @empty

                    <div class="px-6 py-12 text-center">

                        <p class="text-sm text-gray-400">
                            Belum ada data penjualan.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- =================================================
            TRANSAKSI TERBARU
        ================================================== --}}

        <div
            class="
                bg-white
                rounded-2xl
                border border-gray-200
                shadow-sm
                overflow-hidden
            "
        >

            <div
                class="
                    px-6
                    py-5
                    border-b border-gray-100
                "
            >

                <h2 class="text-lg font-bold text-gray-800">
                    Transaksi Terbaru
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Sepuluh transaksi terakhir yang telah dibayar.
                </p>

            </div>


            <div class="divide-y divide-gray-100">

                @forelse ($recentOrders as $order)

                    <div
                        class="
                            px-6
                            py-4
                            flex
                            items-center
                            justify-between
                            gap-4
                        "
                    >

                        <div class="min-w-0">

                            <p
                                class="
                                    text-sm
                                    font-semibold
                                    text-gray-800
                                "
                            >
                                {{ $order->order_code }}
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                {{ $order->customer_name }}
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>

                        </div>


                        <div class="text-right flex-shrink-0">

                            <p
                                class="
                                    text-sm
                                    font-bold
                                    text-pink-600
                                "
                            >
                                Rp{{ number_format(
                                    $order->total_amount,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </p>

                            <span
                                class="
                                    inline-flex
                                    mt-1
                                    px-2.5
                                    py-1
                                    rounded-full
                                    bg-green-100
                                    text-green-700
                                    text-xs
                                    font-semibold
                                "
                            >
                                Dibayar
                            </span>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-12 text-center">

                        <p class="text-sm text-gray-400">
                            Belum ada transaksi.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection