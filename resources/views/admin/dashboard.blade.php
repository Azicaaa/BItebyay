@extends('layouts.admin')

@section('content')

<div class="py-8">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="mb-8">

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Dashboard
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Ringkasan aktivitas pesanan BitebyAy.
            </p>

        </div>


        {{-- =====================================================
            SUMMARY CARDS
        ====================================================== --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            {{-- Total Pesanan --}}

            <div
                class="
                    bg-white
                    rounded-2xl
                    border border-gray-200
                    shadow-sm
                    p-5
                "
            >

                <p class="text-sm text-gray-500">
                    Total Pesanan
                </p>

                <p class="mt-2 text-3xl font-bold text-gray-800">
                    {{ $totalOrders }}
                </p>

            </div>


            {{-- Menunggu Pembayaran --}}

            <div
                class="
                    bg-white
                    rounded-2xl
                    border border-gray-200
                    shadow-sm
                    p-5
                "
            >

                <p class="text-sm text-gray-500">
                    Menunggu Pembayaran
                </p>

                <p class="mt-2 text-3xl font-bold text-yellow-600">
                    {{ $pendingPayments }}
                </p>

            </div>


            {{-- Sedang Diproses --}}

            <div
                class="
                    bg-white
                    rounded-2xl
                    border border-gray-200
                    shadow-sm
                    p-5
                "
            >

                <p class="text-sm text-gray-500">
                    Sedang Diproses
                </p>

                <p class="mt-2 text-3xl font-bold text-blue-600">
                    {{ $processingOrders }}
                </p>

            </div>


            {{-- Selesai --}}

            <div
                class="
                    bg-white
                    rounded-2xl
                    border border-gray-200
                    shadow-sm
                    p-5
                "
            >

                <p class="text-sm text-gray-500">
                    Pesanan Selesai
                </p>

                <p class="mt-2 text-3xl font-bold text-green-600">
                    {{ $completedOrders }}
                </p>

            </div>

        </div>


        {{-- =====================================================
            RECENT ORDERS
        ====================================================== --}}

        <div class="mt-8">

            <div
                class="
                    bg-white
                    rounded-2xl
                    border border-gray-200
                    shadow-sm
                    overflow-hidden
                "
            >

                {{-- Header --}}

                <div
                    class="
                        px-5 sm:px-6
                        py-5
                        border-b border-gray-100
                        flex
                        items-center
                        justify-between
                        gap-4
                    "
                >

                    <div>

                        <h2 class="text-lg font-bold text-gray-800">
                            Pesanan Terbaru
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Lima pesanan terakhir.
                        </p>

                    </div>


                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="
                            text-sm
                            font-semibold
                            text-pink-600
                            hover:text-pink-700
                        "
                    >
                        Lihat Semua
                    </a>

                </div>


                {{-- Table --}}

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50">

                            <tr>

                                <th
                                    class="
                                        px-5 py-3
                                        text-left
                                        font-semibold
                                        text-gray-600
                                    "
                                >
                                    Pesanan
                                </th>

                                <th
                                    class="
                                        px-5 py-3
                                        text-left
                                        font-semibold
                                        text-gray-600
                                    "
                                >
                                    Customer
                                </th>

                                <th
                                    class="
                                        px-5 py-3
                                        text-left
                                        font-semibold
                                        text-gray-600
                                    "
                                >
                                    Total
                                </th>

                                <th
                                    class="
                                        px-5 py-3
                                        text-left
                                        font-semibold
                                        text-gray-600
                                    "
                                >
                                    Pembayaran
                                </th>

                                <th
                                    class="
                                        px-5 py-3
                                        text-left
                                        font-semibold
                                        text-gray-600
                                    "
                                >
                                    Status
                                </th>

                                <th
                                    class="
                                        px-5 py-3
                                        text-right
                                        font-semibold
                                        text-gray-600
                                    "
                                >
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse ($recentOrders as $order)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- Order --}}

                                    <td class="px-5 py-4">

                                        <p class="font-semibold text-gray-800">
                                            {{ $order->order_code }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-400">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </p>

                                    </td>


                                    {{-- Customer --}}

                                    <td class="px-5 py-4">

                                        <p class="font-medium text-gray-800">
                                            {{ $order->customer_name }}
                                        </p>

                                    </td>


                                    {{-- Total --}}

                                    <td class="px-5 py-4">

                                        <span class="font-semibold text-gray-800">
                                            Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                        </span>

                                    </td>


                                    {{-- Payment --}}

                                    <td class="px-5 py-4">

                                        @if ($order->payment?->status === 'paid')

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    rounded-full
                                                    text-xs
                                                    font-semibold
                                                    bg-green-100
                                                    text-green-700
                                                "
                                            >
                                                Dikonfirmasi
                                            </span>

                                        @elseif ($order->payment?->status === 'rejected')

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    rounded-full
                                                    text-xs
                                                    font-semibold
                                                    bg-red-100
                                                    text-red-700
                                                "
                                            >
                                                Ditolak
                                            </span>

                                        @else

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    rounded-full
                                                    text-xs
                                                    font-semibold
                                                    bg-yellow-100
                                                    text-yellow-700
                                                "
                                            >
                                                Menunggu Pembayaran
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Order Status --}}

                                    <td class="px-5 py-4">

                                        @if ($order->order_status === 'completed')

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    rounded-full
                                                    text-xs
                                                    font-semibold
                                                    bg-green-100
                                                    text-green-700
                                                "
                                            >
                                                Selesai
                                            </span>

                                        @elseif ($order->order_status === 'processing')

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    rounded-full
                                                    text-xs
                                                    font-semibold
                                                    bg-blue-100
                                                    text-blue-700
                                                "
                                            >
                                                Sedang Diproses
                                            </span>

                                        @elseif ($order->order_status === 'cancelled')

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    rounded-full
                                                    text-xs
                                                    font-semibold
                                                    bg-red-100
                                                    text-red-700
                                                "
                                            >
                                                Dibatalkan
                                            </span>

                                        @else

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    rounded-full
                                                    text-xs
                                                    font-semibold
                                                    bg-gray-100
                                                    text-gray-600
                                                "
                                            >
                                                Menunggu Pembayaran
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}

                                    <td class="px-5 py-4 text-right">

                                        <a
                                            href="{{ route('admin.orders.show', $order) }}"
                                            class="
                                                inline-flex
                                                items-center
                                                px-4 py-2
                                                rounded-lg
                                                bg-pink-600
                                                hover:bg-pink-700
                                                text-white
                                                text-xs
                                                font-semibold
                                                transition
                                            "
                                        >
                                            Detail
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="
                                            px-5 py-12
                                            text-center
                                            text-gray-400
                                        "
                                    >
                                        Belum ada pesanan.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection