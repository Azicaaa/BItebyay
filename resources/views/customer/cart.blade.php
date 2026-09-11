@extends('layouts.customer')

@section('content')

<section class="bg-pink-50 min-h-screen py-8 sm:py-10">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="mb-7 sm:mb-8">

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                Keranjang Belanja
            </h1>

        </div>


        {{-- =====================================================
            EMPTY CART
        ====================================================== --}}

        @if (empty($cart))

            <div
                class="bg-white rounded-2xl
                       border border-pink-100
                       shadow-sm
                       px-6 py-14
                       text-center"
            >

                <div
                    class="mx-auto w-14 h-14
                           rounded-full
                           bg-pink-50
                           flex items-center justify-center
                           text-2xl"
                >
                    🛒
                </div>

                <h2 class="mt-4 text-xl font-semibold text-gray-800">
                    Keranjang masih kosong
                </h2>

                <p class="mt-2 text-gray-500 text-sm">
                    Yuk pilih dessert favoritmu terlebih dahulu.
                </p>

                <a
                    href="{{ route('home') }}#menu"
                    class="inline-flex items-center justify-center
                           mt-5 px-6 py-3
                           bg-pink-600 hover:bg-pink-700
                           text-white font-semibold
                           rounded-full
                           transition duration-300"
                >
                    Lihat Menu
                </a>

            </div>

        @else


            {{-- =================================================
                CART + SUMMARY
            ================================================== --}}

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-7">


                {{-- =============================================
                    CART ITEMS
                ============================================== --}}

                <div class="lg:col-span-2">

                    <div
                        class="bg-white
                               rounded-2xl
                               border border-pink-100
                               shadow-sm
                               overflow-hidden"
                    >

                        {{-- Cart Header --}}

                        <div
                            class="px-5 sm:px-6 py-4
                                border-b border-gray-100"
                        >
                            <h2 class="font-bold text-gray-800">
                                Produk Pilihan
                            </h2>
                        </div>


                        {{-- Products --}}

                        <div class="divide-y divide-gray-100">

                            @foreach ($cart as $item)

                                <div
                                    class="p-4 sm:p-5
                                           flex items-center gap-4"
                                >

                                    {{-- Product Image --}}

                                    <div
                                        class="w-20 h-20
                                               sm:w-24 sm:h-24
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
                                                   text-gray-800
                                                   text-sm sm:text-base
                                                   truncate"
                                        >
                                            {{ $item['name'] }}
                                        </h3>

                                        <p
                                            class="mt-1
                                                   text-pink-600
                                                   font-semibold
                                                   text-sm"
                                        >
                                            Rp{{ number_format($item['price'], 0, ',', '.') }}
                                        </p>


                                        {{-- =================================
                                            AUTO UPDATE QUANTITY
                                        ================================== --}}

                                        <form
                                            id="update-cart-{{ $item['id'] }}"
                                            action="{{ route('cart.update', $item['id']) }}"
                                            method="POST"
                                            class="mt-2.5 flex items-center"
                                        >

                                            @csrf
                                            @method('PATCH')


                                            <div
                                                class="flex items-center
                                                       border border-gray-200
                                                       rounded-lg
                                                       overflow-hidden
                                                       bg-white"
                                            >

                                                {{-- Minus --}}

                                                <button
                                                    type="button"
                                                    onclick="
                                                        const input = this.parentElement.querySelector('input[name=quantity]');
                                                        if (parseInt(input.value) > 1) {
                                                            input.value = parseInt(input.value) - 1;
                                                            this.closest('form').submit();
                                                        }
                                                    "
                                                    class="w-8 h-8
                                                           flex items-center
                                                           justify-center
                                                           text-gray-500
                                                           hover:bg-pink-50
                                                           hover:text-pink-600
                                                           transition"
                                                    aria-label="Kurangi jumlah"
                                                >
                                                    −
                                                </button>


                                                {{-- Quantity --}}

                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    value="{{ $item['quantity'] }}"
                                                    min="1"
                                                    onchange="this.form.submit()"
                                                    class="w-9 h-8
                                                           border-0
                                                           text-center
                                                           text-sm
                                                           font-semibold
                                                           text-gray-800
                                                           focus:ring-0
                                                           p-0"
                                                    aria-label="Jumlah {{ $item['name'] }}"
                                                >


                                                {{-- Plus --}}

                                                <button
                                                    type="button"
                                                    onclick="
                                                        const input = this.parentElement.querySelector('input[name=quantity]');
                                                        input.value = parseInt(input.value) + 1;
                                                        this.closest('form').submit();
                                                    "
                                                    class="w-8 h-8
                                                           flex items-center
                                                           justify-center
                                                           text-gray-500
                                                           hover:bg-pink-50
                                                           hover:text-pink-600
                                                           transition"
                                                    aria-label="Tambah jumlah"
                                                >
                                                    +
                                                </button>

                                            </div>

                                        </form>

                                    </div>


                                    {{-- =================================
                                        RIGHT SIDE
                                    ================================== --}}

                                    <div
                                        class="flex flex-col
                                               items-end
                                               justify-between
                                               self-stretch
                                               flex-shrink-0"
                                    >

                                        {{-- Remove --}}

                                        <form
                                            action="{{ route('cart.remove', $item['id']) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="w-7 h-7
                                                       flex items-center
                                                       justify-center
                                                       rounded-full
                                                       text-gray-400
                                                       hover:text-red-500
                                                       hover:bg-red-50
                                                       transition"
                                                title="Hapus produk"
                                                aria-label="Hapus {{ $item['name'] }}"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12"
                                                    />

                                                </svg>

                                            </button>

                                        </form>


                                        {{-- Item Subtotal --}}

                                        <p
                                            class="text-sm
                                                   sm:text-base
                                                   font-bold
                                                   text-gray-800
                                                   whitespace-nowrap"
                                        >
                                            Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </p>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    ORDER SUMMARY
                ============================================== --}}

                <div class="lg:col-span-1">

                    <div
                        class="bg-white
                               rounded-2xl
                               border border-pink-100
                               shadow-sm
                               p-5 sm:p-6
                               lg:sticky lg:top-24"
                    >

                        <h2
                            class="text-lg sm:text-xl
                                   font-bold text-gray-800"
                        >
                            Ringkasan Pesanan
                        </h2>


                        {{-- Summary --}}

                        <div
                            class="mt-5
                                   space-y-3
                                   text-sm"
                        >

                            {{-- Item Count --}}

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Jumlah item
                                </span>

                                <span class="font-medium text-gray-800">
                                    {{ collect($cart)->sum('quantity') }}
                                </span>

                            </div>


                            {{-- Subtotal --}}

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Subtotal
                                </span>

                                <span class="font-semibold text-gray-800">
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>


                        {{-- Divider --}}

                        <div class="my-5 border-t border-gray-100"></div>


                        {{-- Total --}}

                        <div class="flex justify-between items-center">

                            <span class="font-semibold text-gray-800">
                                Total
                            </span>

                            <span
                                class="text-xl
                                       font-bold
                                       text-pink-600"
                            >
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </span>

                        </div>


                        {{-- Checkout --}}

                        <a
                            href="{{ route('checkout.index') }}"
                            class="mt-5
                                   w-full
                                   inline-flex
                                   items-center
                                   justify-center
                                   py-3
                                   bg-pink-600
                                   hover:bg-pink-700
                                   text-white
                                   font-semibold
                                   rounded-full
                                   transition duration-300"
                        >
                            Checkout
                        </a>


                        {{-- Continue Shopping --}}

                        <a
                            href="{{ route('home') }}#menu"
                            class="mt-2.5
                                   w-full
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
                            Lanjut Belanja
                        </a>

                    </div>

                </div>

            </div>

        @endif

    </div>

</section>

@endsection