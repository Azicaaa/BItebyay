@extends('layouts.customer')

@section('content')

<section
    class="bg-pink-50 min-h-screen py-10 sm:py-14"
    x-data="{
        activeTab: 'active',
        modalOpen: false,
        selectedOrder: null,

        openOrder(order) {
            this.selectedOrder = order;
            this.modalOpen = true;
            document.body.classList.add('overflow-hidden');
        },

        closeOrder() {
            this.modalOpen = false;
            this.selectedOrder = null;
            document.body.classList.remove('overflow-hidden');
        }
    }"
>

    <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="mb-8">

            <p class="text-sm font-semibold text-pink-600">
                Akun Saya
            </p>

            <h1 class="mt-1 text-3xl sm:text-4xl font-bold text-gray-800">
                Pesanan Saya
            </h1>

            <p class="mt-2 text-gray-500">
                Lihat status dan riwayat pesanan Anda.
            </p>

        </div>


        {{-- =====================================================
            TAB
        ====================================================== --}}

        <div class="mb-7">

            <div
                class="
                    inline-flex
                    p-1
                    bg-white
                    border border-pink-100
                    rounded-full
                    shadow-sm
                "
            >

                {{-- Aktif --}}

                <button
                    type="button"
                    @click="activeTab = 'active'"
                    class="
                        px-6
                        py-2.5
                        rounded-full
                        text-sm
                        font-semibold
                        transition
                    "
                    :class="
                        activeTab === 'active'
                            ? 'bg-pink-600 text-white'
                            : 'text-gray-500 hover:text-pink-600'
                    "
                >
                    Aktif
                </button>


                {{-- Selesai --}}

                <button
                    type="button"
                    @click="activeTab = 'completed'"
                    class="
                        px-6
                        py-2.5
                        rounded-full
                        text-sm
                        font-semibold
                        transition
                    "
                    :class="
                        activeTab === 'completed'
                            ? 'bg-pink-600 text-white'
                            : 'text-gray-500 hover:text-pink-600'
                    "
                >
                    Selesai
                </button>

            </div>

        </div>


        {{-- =====================================================
            ORDERS
        ====================================================== --}}

        @if ($orders->isEmpty())

            <div
                class="
                    bg-white
                    rounded-2xl
                    border border-pink-100
                    shadow-sm
                    px-6 py-16
                    text-center
                "
            >

                <div
                    class="
                        mx-auto
                        w-16 h-16
                        rounded-full
                        bg-pink-50
                        flex items-center justify-center
                        text-2xl
                    "
                >
                    🛍️
                </div>

                <h2 class="mt-5 text-xl font-semibold text-gray-800">
                    Belum ada pesanan
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Pesanan yang Anda buat akan muncul di sini.
                </p>

                <a
                    href="{{ route('home') }}#menu"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        mt-6
                        px-7 py-3
                        bg-pink-600
                        hover:bg-pink-700
                        text-white
                        font-semibold
                        rounded-full
                        transition
                    "
                >
                    Lihat Menu
                </a>

            </div>

        @else

            {{-- =================================================
                ACTIVE ORDERS
            ================================================== --}}

            <div
                x-show="activeTab === 'active'"
                x-cloak
            >

                @php
                    $activeOrders = $orders->filter(function ($order) {
                        return !in_array(
                            $order->order_status,
                            ['completed']
                        );
                    });
                @endphp


                @if ($activeOrders->isEmpty())

                    <div
                        class="
                            bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            px-6 py-14
                            text-center
                        "
                    >

                        <div
                            class="
                                mx-auto
                                w-14 h-14
                                rounded-full
                                bg-green-50
                                flex items-center justify-center
                                text-xl
                            "
                        >
                            ✓
                        </div>

                        <h2 class="mt-4 text-lg font-semibold text-gray-800">
                            Tidak ada pesanan aktif
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Semua pesanan Anda sudah selesai.
                        </p>

                    </div>

                @else

                    <div class="space-y-4">

                        @foreach ($activeOrders as $order)

                            @php
                                $paymentStatus =
                                    $order->payment?->status ?? 'pending';

                                $orderStatus =
                                    $order->order_status ?? 'pending';

                                $productCount =
                                    $order->items->sum('quantity');

                                $orderData = [
                                    'id' => $order->id,
                                    'order_code' => $order->order_code,
                                    'created_at' => $order->created_at->format('d M Y, H:i'),
                                    'total' => number_format($order->total_amount, 0, ',', '.'),
                                    'payment_status' => $paymentStatus,
                                    'order_status' => $orderStatus,
                                    'payment_method' => $order->payment?->payment_method ?? '-',
                                    'items' => $order->items->map(function ($item) {
                                        return [
                                            'name' => $item->product_name,
                                            'quantity' => $item->quantity,
                                            'price' => number_format($item->price, 0, ',', '.'),
                                            'subtotal' => number_format($item->subtotal, 0, ',', '.'),
                                        ];
                                    })->values(),
                                ];
                            @endphp


                            <div
                                class="
                                    bg-white
                                    rounded-2xl
                                    border border-gray-100
                                    shadow-sm
                                    overflow-hidden
                                "
                            >

                                {{-- Header --}}

                                <div
                                    class="
                                        px-5 sm:px-6
                                        py-4
                                        border-b border-gray-100
                                        flex
                                        flex-col
                                        sm:flex-row
                                        sm:items-center
                                        sm:justify-between
                                        gap-3
                                    "
                                >

                                    <div>

                                        <p class="text-xs text-gray-500">
                                            Nomor Pesanan
                                        </p>

                                        <p class="mt-1 font-bold text-gray-800">
                                            {{ $order->order_code }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-400">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </p>

                                    </div>


                                    {{-- Payment Status --}}

                                    <span
                                        class="
                                            inline-flex
                                            items-center
                                            self-start
                                            sm:self-auto
                                            px-3 py-1.5
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

                                        @if ($paymentStatus === 'paid')
                                            Pembayaran Dikonfirmasi
                                        @elseif ($paymentStatus === 'rejected')
                                            Pembayaran Ditolak
                                        @else
                                            Menunggu Pembayaran
                                        @endif

                                    </span>

                                </div>


                                {{-- Body --}}

                                <div class="px-5 sm:px-6 py-5">

                                    <div
                                        class="
                                            flex
                                            flex-col
                                            sm:flex-row
                                            sm:items-center
                                            sm:justify-between
                                            gap-5
                                        "
                                    >

                                        <div>

                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $productCount }} produk
                                            </p>

                                            <p class="mt-1 text-xs text-gray-500">
                                                Total pesanan
                                            </p>

                                        </div>


                                        <div class="sm:text-right">

                                            <p class="text-lg font-bold text-pink-600">
                                                Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                            </p>

                                            <p
                                                class="
                                                    mt-1
                                                    text-xs
                                                    font-semibold
                                                    @if ($orderStatus === 'processing')
                                                        text-blue-600
                                                    @elseif ($orderStatus === 'completed')
                                                        text-green-600
                                                    @elseif ($orderStatus === 'cancelled')
                                                        text-red-600
                                                    @else
                                                        text-gray-500
                                                    @endif
                                                "
                                            >

                                                @if ($orderStatus === 'processing')
                                                    Sedang Diproses
                                                @elseif ($orderStatus === 'completed')
                                                    Selesai
                                                @elseif ($orderStatus === 'cancelled')
                                                    Dibatalkan
                                                @else
                                                    Menunggu Pembayaran
                                                @endif

                                            </p>

                                        </div>

                                    </div>


                                    {{-- Actions --}}

                                    <div
                                        class="
                                            mt-5
                                            pt-5
                                            border-t border-gray-100
                                            flex
                                            flex-col
                                            sm:flex-row
                                            gap-3
                                        "
                                    >

                                        <button
                                            type="button"
                                            @click="openOrder({{ \Illuminate\Support\Js::from($orderData) }})"
                                            class="
                                                flex-1
                                                inline-flex
                                                items-center
                                                justify-center
                                                py-3
                                                border
                                                border-pink-200
                                                text-pink-600
                                                hover:bg-pink-50
                                                font-semibold
                                                rounded-full
                                                transition
                                            "
                                        >
                                            Lihat Pesanan
                                        </button>


                                        @if ($paymentStatus === 'pending')

                                            <a
                                                href="{{ route('payment.show', $order) }}"
                                                class="
                                                    flex-1
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    py-3
                                                    bg-pink-600
                                                    hover:bg-pink-700
                                                    text-white
                                                    font-semibold
                                                    rounded-full
                                                    transition
                                                "
                                            >
                                                Bayar Sekarang
                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- =================================================
                COMPLETED ORDERS
            ================================================== --}}

            <div
                x-show="activeTab === 'completed'"
                x-cloak
                style="display: none;"
            >

                @php
                    $completedOrders = $orders->filter(function ($order) {
                        return $order->order_status === 'completed';
                    });
                @endphp


                @if ($completedOrders->isEmpty())

                    <div
                        class="
                            bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            px-6 py-14
                            text-center
                        "
                    >

                        <div
                            class="
                                mx-auto
                                w-14 h-14
                                rounded-full
                                bg-gray-50
                                flex items-center justify-center
                                text-xl
                            "
                        >
                            📋
                        </div>

                        <h2 class="mt-4 text-lg font-semibold text-gray-800">
                            Belum ada riwayat pesanan
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Pesanan yang sudah selesai akan muncul di sini.
                        </p>

                    </div>

                @else

                    <div class="space-y-3">

                        @foreach ($completedOrders as $order)

                            @php
                                $productCount =
                                    $order->items->sum('quantity');

                                $orderData = [
                                    'id' => $order->id,
                                    'order_code' => $order->order_code,
                                    'created_at' => $order->created_at->format('d M Y, H:i'),
                                    'total' => number_format($order->total_amount, 0, ',', '.'),
                                    'payment_status' => $order->payment?->status ?? 'pending',
                                    'order_status' => $order->order_status ?? 'completed',
                                    'payment_method' => $order->payment?->payment_method ?? '-',
                                    'items' => $order->items->map(function ($item) {
                                        return [
                                            'name' => $item->product_name,
                                            'quantity' => $item->quantity,
                                            'price' => number_format($item->price, 0, ',', '.'),
                                            'subtotal' => number_format($item->subtotal, 0, ',', '.'),
                                        ];
                                    })->values(),
                                ];
                            @endphp


                            <div
                                class="
                                    bg-white
                                    rounded-2xl
                                    border border-gray-100
                                    shadow-sm
                                    px-5 py-4
                                    flex
                                    items-center
                                    justify-between
                                    gap-5
                                "
                            >

                                <div class="min-w-0">

                                    <div
                                        class="
                                            flex
                                            flex-wrap
                                            items-center
                                            gap-2
                                        "
                                    >

                                        <p class="font-bold text-gray-800">
                                            {{ $order->order_code }}
                                        </p>

                                        <span
                                            class="
                                                px-2.5 py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                bg-green-100
                                                text-green-700
                                            "
                                        >
                                            Selesai
                                        </span>

                                    </div>

                                    <p class="mt-1 text-xs text-gray-400">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>

                                    <p class="mt-2 text-sm text-gray-500">
                                        {{ $productCount }} produk
                                    </p>

                                </div>


                                <div class="flex items-center gap-4">

                                    <p
                                        class="
                                            text-sm
                                            sm:text-base
                                            font-bold
                                            text-gray-800
                                            whitespace-nowrap
                                        "
                                    >
                                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                    </p>


                                    <button
                                        type="button"
                                        @click="openOrder({{ \Illuminate\Support\Js::from($orderData) }})"
                                        class="
                                            hidden
                                            sm:inline-flex
                                            items-center
                                            justify-center
                                            px-4 py-2.5
                                            border
                                            border-pink-200
                                            text-pink-600
                                            hover:bg-pink-50
                                            font-semibold
                                            text-sm
                                            rounded-full
                                            transition
                                        "
                                    >
                                        Lihat
                                    </button>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        @endif

    </div>


    {{-- =====================================================
        DETAIL MODAL
    ====================================================== --}}

    <div
        x-show="modalOpen"
        x-cloak
        x-transition.opacity
        class="
            fixed
            inset-0
            z-[100]
            flex
            items-center
            justify-center
            p-4
        "
        @keydown.escape.window="closeOrder()"
    >

        {{-- Overlay --}}

        <div
            class="
                absolute
                inset-0
                bg-black/40
                backdrop-blur-sm
            "
            @click="closeOrder()"
        ></div>


        {{-- Modal --}}

        <div
            x-show="modalOpen"
            x-transition
            @click.stop
            class="
                relative
                z-10
                w-full
                max-w-lg
                max-h-[85vh]
                overflow-y-auto
                bg-white
                rounded-2xl
                shadow-2xl
            "
        >

            {{-- Modal Header --}}

            <div
                class="
                    px-6 py-5
                    border-b border-gray-100
                    flex
                    items-center
                    justify-between
                    gap-4
                "
            >

                <div>

                    <p class="text-xs text-gray-500">
                        Detail Pesanan
                    </p>

                    <h2
                        class="
                            mt-1
                            text-lg
                            font-bold
                            text-gray-800
                        "
                        x-text="selectedOrder?.order_code"
                    ></h2>

                </div>


                <button
                    type="button"
                    @click="closeOrder()"
                    class="
                        w-9 h-9
                        rounded-full
                        flex
                        items-center
                        justify-center
                        text-gray-400
                        hover:text-gray-700
                        hover:bg-gray-100
                        transition
                    "
                >
                    ✕
                </button>

            </div>


            {{-- Modal Content --}}

            <div class="px-6 py-5">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-xs text-gray-500">
                            Tanggal Pesanan
                        </p>

                        <p
                            class="mt-1 text-sm font-semibold text-gray-800"
                            x-text="selectedOrder?.created_at"
                        ></p>

                    </div>


                    <div class="text-right">

                        <p class="text-xs text-gray-500">
                            Metode Pembayaran
                        </p>

                        <p
                            class="mt-1 text-sm font-semibold text-gray-800 uppercase"
                            x-text="selectedOrder?.payment_method"
                        ></p>

                    </div>

                </div>


                {{-- Products --}}

                <div class="mt-6">

                    <h3 class="text-sm font-bold text-gray-800">
                        Produk
                    </h3>


                    <div class="mt-3 divide-y divide-gray-100">

                        <template
                            x-for="item in (selectedOrder?.items ?? [])"
                            :key="item.name + item.quantity + item.subtotal"
                        >

                            <div
                                class="
                                    py-3
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
                                        x-text="item.name"
                                    ></p>

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            text-gray-500
                                        "
                                        x-text="item.quantity + ' × Rp' + item.price"
                                    ></p>

                                </div>


                                <p
                                    class="
                                        text-sm
                                        font-semibold
                                        text-gray-800
                                        whitespace-nowrap
                                    "
                                    x-text="'Rp' + item.subtotal"
                                ></p>

                            </div>

                        </template>

                    </div>

                </div>


                {{-- Total --}}

                <div
                    class="
                        mt-5
                        pt-5
                        border-t border-gray-100
                    "
                >

                    <div class="flex items-center justify-between">

                        <span class="font-semibold text-gray-800">
                            Total
                        </span>

                        <span
                            class="text-xl font-bold text-pink-600"
                            x-text="'Rp' + selectedOrder?.total"
                        ></span>

                    </div>

                </div>


                {{-- Status --}}

                <div class="mt-5 space-y-3">

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            gap-4
                            rounded-xl
                            bg-gray-50
                            px-4 py-3
                        "
                    >

                        <span class="text-sm text-gray-500">
                            Pembayaran
                        </span>

                        <span
                            class="text-sm font-semibold text-gray-800"
                            x-text="
                                selectedOrder?.payment_status === 'paid'
                                    ? 'Dikonfirmasi'
                                    : selectedOrder?.payment_status === 'rejected'
                                        ? 'Ditolak'
                                        : 'Menunggu Pembayaran'
                            "
                        ></span>

                    </div>


                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            gap-4
                            rounded-xl
                            bg-gray-50
                            px-4 py-3
                        "
                    >

                        <span class="text-sm text-gray-500">
                            Status Pesanan
                        </span>

                        <span
                            class="text-sm font-semibold text-gray-800"
                            x-text="
                                selectedOrder?.order_status === 'processing'
                                    ? 'Sedang Diproses'
                                    : selectedOrder?.order_status === 'completed'
                                        ? 'Selesai'
                                        : selectedOrder?.order_status === 'cancelled'
                                            ? 'Dibatalkan'
                                            : 'Menunggu Pembayaran'
                            "
                        ></span>

                    </div>

                </div>

            </div>


            {{-- Modal Footer --}}

            <div
                class="
                    px-6 py-4
                    border-t border-gray-100
                    flex
                    justify-end
                "
            >

                <button
                    type="button"
                    @click="closeOrder()"
                    class="
                        px-6 py-2.5
                        bg-gray-100
                        hover:bg-gray-200
                        text-gray-700
                        font-semibold
                        text-sm
                        rounded-full
                        transition
                    "
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>

</section>

@endsection