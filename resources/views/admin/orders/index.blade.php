@extends('layouts.admin')

@section('content')

<div class="py-8">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="mb-8">

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Pesanan
            </h1>

            <p class="mt-1 text-sm sm:text-base text-gray-500">
                Kelola pesanan customer BitebyAy.
            </p>

        </div>


        {{-- =====================================================
            ORDER TABLE
        ====================================================== --}}

        <div
            class="
                bg-white
                rounded-2xl
                border border-gray-200
                shadow-sm
                overflow-hidden
            "
        >

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    {{-- =================================================
                        TABLE HEADER
                    ================================================== --}}

                    <thead class="bg-gray-50">

                        <tr>

                            <th
                                class="
                                    px-5 py-4
                                    text-left
                                    font-semibold
                                    text-gray-600
                                    whitespace-nowrap
                                "
                            >
                                Pesanan
                            </th>


                            <th
                                class="
                                    px-5 py-4
                                    text-left
                                    font-semibold
                                    text-gray-600
                                    whitespace-nowrap
                                "
                            >
                                Customer
                            </th>


                            <th
                                class="
                                    px-5 py-4
                                    text-left
                                    font-semibold
                                    text-gray-600
                                    whitespace-nowrap
                                "
                            >
                                Total
                            </th>


                            <th
                                class="
                                    px-5 py-4
                                    text-left
                                    font-semibold
                                    text-gray-600
                                    whitespace-nowrap
                                "
                            >
                                Pembayaran
                            </th>


                            <th
                                class="
                                    px-5 py-4
                                    text-left
                                    font-semibold
                                    text-gray-600
                                    whitespace-nowrap
                                "
                            >
                                Status
                            </th>


                            <th
                                class="
                                    px-5 py-4
                                    text-right
                                    font-semibold
                                    text-gray-600
                                    whitespace-nowrap
                                "
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    {{-- =================================================
                        TABLE BODY
                    ================================================== --}}

                    <tbody class="divide-y divide-gray-100">

                        @forelse ($orders as $order)

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | Payment Status
                                |--------------------------------------------------------------------------
                                */

                                $paymentStatus = $order->payment_status ?? 'pending';

                                $paymentLabel = match ($paymentStatus) {
                                    'paid'     => 'Dikonfirmasi',
                                    'rejected' => 'Ditolak',
                                    default    => 'Menunggu Pembayaran',
                                };


                                /*
                                |--------------------------------------------------------------------------
                                | Order Status
                                |--------------------------------------------------------------------------
                                */

                                $orderStatus = $order->order_status ?? 'pending';

                                $orderLabel = match ($orderStatus) {
                                    'processing' => 'Sedang Diproses',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                    default     => 'Menunggu Pembayaran',
                                };

                            @endphp


                            <tr
                                class="
                                    hover:bg-gray-50
                                    transition
                                    duration-150
                                "
                            >

                                {{-- =================================================
                                    ORDER
                                ================================================== --}}

                                <td class="px-5 py-4">

                                    <p
                                        class="
                                            font-semibold
                                            text-gray-800
                                            whitespace-nowrap
                                        "
                                    >
                                        {{ $order->order_code }}
                                    </p>

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            text-gray-400
                                            whitespace-nowrap
                                        "
                                    >
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>

                                </td>


                                {{-- =================================================
                                    CUSTOMER
                                ================================================== --}}

                                <td class="px-5 py-4">

                                    <p
                                        class="
                                            font-medium
                                            text-gray-800
                                            whitespace-nowrap
                                        "
                                    >
                                        {{ $order->customer_name }}
                                    </p>

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            text-gray-500
                                            whitespace-nowrap
                                        "
                                    >
                                        {{ $order->phone }}
                                    </p>

                                </td>


                                {{-- =================================================
                                    TOTAL
                                ================================================== --}}

                                <td class="px-5 py-4">

                                    <span
                                        class="
                                            font-semibold
                                            text-gray-800
                                            whitespace-nowrap
                                        "
                                    >
                                        Rp{{ number_format(
                                            $order->total_amount,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>


                                {{-- =================================================
                                    PAYMENT
                                ================================================== --}}

                                <td class="px-5 py-4">

                                    @if ($paymentStatus === 'paid')

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                px-3 py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                bg-green-100
                                                text-green-700
                                                whitespace-nowrap
                                            "
                                        >
                                            {{ $paymentLabel }}
                                        </span>


                                    @elseif ($paymentStatus === 'rejected')

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                px-3 py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                bg-red-100
                                                text-red-700
                                                whitespace-nowrap
                                            "
                                        >
                                            {{ $paymentLabel }}
                                        </span>


                                    @else

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                px-3 py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                bg-yellow-100
                                                text-yellow-700
                                                whitespace-nowrap
                                            "
                                        >
                                            {{ $paymentLabel }}
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    ORDER STATUS
                                ================================================== --}}

                                <td class="px-5 py-4">

                                    @if ($orderStatus === 'completed')

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                px-3 py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                bg-green-100
                                                text-green-700
                                                whitespace-nowrap
                                            "
                                        >
                                            {{ $orderLabel }}
                                        </span>


                                    @elseif ($orderStatus === 'processing')

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                px-3 py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                bg-blue-100
                                                text-blue-700
                                                whitespace-nowrap
                                            "
                                        >
                                            {{ $orderLabel }}
                                        </span>


                                    @elseif ($orderStatus === 'cancelled')

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                px-3 py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                bg-red-100
                                                text-red-700
                                                whitespace-nowrap
                                            "
                                        >
                                            {{ $orderLabel }}
                                        </span>


                                    @else

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                px-3 py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                bg-gray-100
                                                text-gray-600
                                                whitespace-nowrap
                                            "
                                        >
                                            {{ $orderLabel }}
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    ACTION
                                ================================================== --}}

                                <td class="px-5 py-4 text-right">

                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        class="
                                            inline-flex
                                            items-center
                                            justify-center
                                            px-4 py-2
                                            rounded-lg
                                            bg-pink-600
                                            hover:bg-pink-700
                                            text-white
                                            text-xs
                                            font-semibold
                                            transition
                                            duration-150
                                            whitespace-nowrap
                                        "
                                    >
                                        Detail
                                    </a>

                                </td>

                            </tr>


                        @empty

                            {{-- =================================================
                                EMPTY STATE
                            ================================================== --}}

                            <tr>

                                <td
                                    colspan="6"
                                    class="
                                        px-5 py-16
                                        text-center
                                    "
                                >

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="
                                                w-12 h-12
                                                rounded-full
                                                bg-gray-100
                                                flex items-center
                                                justify-center
                                                text-xl
                                            "
                                        >
                                            📋
                                        </div>


                                        <p
                                            class="
                                                mt-4
                                                font-semibold
                                                text-gray-700
                                            "
                                        >
                                            Belum ada pesanan
                                        </p>


                                        <p
                                            class="
                                                mt-1
                                                text-sm
                                                text-gray-400
                                            "
                                        >
                                            Pesanan customer akan muncul di sini.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                PAGINATION
            ====================================================== --}}

            @if ($orders->hasPages())

                <div
                    class="
                        px-5 py-4
                        border-t border-gray-100
                    "
                >

                    {{ $orders->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection