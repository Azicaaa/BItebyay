@extends('layouts.customer')

@section('content')

    {{-- =====================================================
        HERO
    ====================================================== --}}

    <section
        x-data="{
            images: [
                '{{ asset('img/background2.jpg') }}',
                '{{ asset('img/background3.jpg') }}',
                '{{ asset('img/background4.jpg') }}',
                '{{ asset('img/backgroundmochi.jpg') }}'
            ],
            active: 0,
            timer: null,

            init() {
                this.timer = setInterval(() => {
                    this.active = (this.active + 1) % this.images.length;
                }, 5000);
            }
        }"
        class="relative w-full h-[calc(90vh-70px)] min-h-[590px] overflow-hidden"
    >

        {{-- Background --}}
        <template x-for="(image, index) in images" :key="index">

            <div
                x-show="active === index"
                x-transition:enter="transition-opacity duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
            >

                <img
                    :src="image"
                    alt="Dessert BitebyAy"
                    class="w-full h-full object-cover"
                >

            </div>

        </template>


        {{-- Overlay agar tulisan terlihat --}}
        <div class="absolute inset-0 bg-black/40"></div>


        {{-- Hero Content --}}
        <div class="relative z-10 h-full flex items-center">

            <div class="w-full max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">

                <div class="max-w-2xl text-white">

                    <p class="text-base sm:text-lg lg:text-xl font-semibold mb-4 text-pink-100">
                        Dessert Lezat
                    </p>


                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight"
                    >
                        Nikmati Dessert
                        <br>
                        dengan Cita Rasa
                        <br>
                        Tinggi
                    </h1>


                    <p
                        class="mt-6 text-base sm:text-lg lg:text-xl leading-relaxed text-white max-w-xl"
                    >
                        Sajian dessert premium dengan cita rasa lembut dan
                        manis yang dibuat dari bahan berkualitas untuk
                        menemani momen istimewa Anda.
                    </p>


                    <div class="mt-8">

                        <a
                            href="#menu"
                            class="inline-flex items-center justify-center
                                   px-7 py-3.5
                                   bg-pink-600 hover:bg-pink-700
                                   text-white font-semibold
                                   rounded-full
                                   transition duration-300
                                   shadow-lg"
                        >
                            Order Now
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Slider Indicator --}}
        <div
            class="absolute bottom-8 left-1/2
                   -translate-x-1/2
                   z-20
                   flex items-center gap-2"
        >

            <template x-for="(image, index) in images" :key="index">

                <button
                    type="button"
                    @click="active = index"
                    class="h-2 rounded-full transition-all duration-300"
                    :class="active === index
                        ? 'w-8 bg-white'
                        : 'w-2 bg-white/50'"
                ></button>

            </template>

        </div>

    </section>


{{-- =========================================================
    MENU SECTION
========================================================== --}}

<section
    id="menu"
    class="bg-white py-20 sm:py-24 scroll-mt-20"
    x-data="{
        selectedCategory: 'all',
        selectedProduct: null
    }"
>

    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">

        {{-- Section Heading --}}
        <div class="text-center mb-12">

            <p class="text-lg font-semibold text-pink-600 mb-3">
                Our Menu
            </p>

            <h2 class="text-4xl sm:text-5xl font-bold text-gray-800">
                Menu Delicious Kami
            </h2>

            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">
                Temukan berbagai pilihan dessert lezat yang
                dibuat khusus untuk menemani setiap momen Anda.
            </p>

        </div>


        {{-- =====================================================
            CATEGORY FILTER
        ====================================================== --}}

        <div class="flex flex-wrap justify-center gap-3 mb-12">

            {{-- Semua --}}
            <button
                type="button"
                @click="selectedCategory = 'all'"
                class="px-6 py-3 rounded-full font-semibold
                       border transition duration-300"
                :class="selectedCategory === 'all'
                    ? 'bg-pink-600 text-white border-pink-600'
                    : 'bg-white text-pink-600 border-pink-200 hover:bg-pink-50'"
            >
                Semua
            </button>


            {{-- Categories --}}
            @foreach ($categories as $category)

                <button
                    type="button"
                    @click="selectedCategory = {{ $category->id }}"
                    class="px-6 py-3 rounded-full font-semibold
                           border transition duration-300"
                    :class="selectedCategory === {{ $category->id }}
                        ? 'bg-pink-600 text-white border-pink-600'
                        : 'bg-white text-pink-600 border-pink-200 hover:bg-pink-50'"
                >
                    {{ $category->name }}
                </button>

            @endforeach

        </div>


        {{-- =====================================================
            PRODUCT GRID
        ====================================================== --}}

        <div
            class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 sm:gap-6"
        >

            @foreach ($products as $product)

                <div
                    x-show="
                        selectedCategory === 'all'
                        || selectedCategory === {{ $product->category_id }}
                    "
                    x-transition
                    @click="
                        selectedProduct = {
                            id: {{ $product->id }},
                            name: @js($product->name),
                            description: @js($product->description),
                            price: {{ $product->price }},
                            image: @js($product->image),
                            category: @js($product->category?->name)
                        }
                    "
                    class="group bg-white rounded-2xl overflow-hidden
                        border border-gray-100
                        shadow-sm hover:shadow-lg
                        transition duration-300
                        cursor-pointer"
                >

                    {{-- Product Image --}}
                    <div class="aspect-square overflow-hidden bg-gray-100">

                        <img
                            src="{{ asset('img/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover
                                group-hover:scale-105
                                transition duration-500"
                        >

                    </div>


                    {{-- Product Information --}}
                    <div class="p-4 sm:p-5">

                        <h3
                            class="font-semibold text-gray-800
                                text-sm sm:text-base
                                line-clamp-2"
                        >
                            {{ $product->name }}
                        </h3>

                        <p
                            class="mt-2 text-pink-600
                                font-bold text-sm sm:text-base"
                        >
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- Jika belum ada produk --}}
        @if ($products->isEmpty())

            <div class="text-center py-12 text-gray-400">
                Belum ada produk yang tersedia.
            </div>

        @endif

    {{-- =========================================================
        PRODUCT DETAIL MODAL
    ========================================================== --}}

    <div
        x-show="selectedProduct !== null"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-[100]
            flex items-center justify-center
            bg-black/50 backdrop-blur-sm
            px-4 py-6"
        @keydown.escape.window="selectedProduct = null"
        @click.self="selectedProduct = null"
    >

        <div
            x-show="selectedProduct !== null"
            x-transition
            class="relative w-full max-w-4xl
                max-h-[90vh]
                overflow-y-auto
                bg-white rounded-3xl
                shadow-2xl"
        >

            {{-- Close Button --}}
            <button
                type="button"
                @click="selectedProduct = null"
                class="absolute top-4 right-4 z-10
                    w-10 h-10
                    flex items-center justify-center
                    rounded-full
                    bg-white/90
                    text-gray-700
                    hover:bg-pink-600
                    hover:text-white
                    shadow-md
                    transition duration-300"
                aria-label="Tutup"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>


            {{-- Modal Content --}}
            <div class="grid grid-cols-1 md:grid-cols-2">

                {{-- Product Image --}}
                <div class="bg-pink-50">

                    <img
                        :src="'{{ asset('img') }}/' + selectedProduct?.image"
                        :alt="selectedProduct?.name"
                        class="w-full
                            h-[300px] sm:h-[400px] md:h-full
                            min-h-[300px]
                            object-cover"
                    >

                </div>


                {{-- Product Details --}}
                <div
                    class="p-6 sm:p-8 lg:p-10
                        flex flex-col justify-center"
                >

                    {{-- Category --}}
                    <p
                        class="text-sm font-semibold
                            text-pink-600 uppercase tracking-wide"
                        x-text="selectedProduct?.category"
                    ></p>


                    {{-- Name --}}
                    <h2
                        class="mt-2
                            text-2xl sm:text-3xl
                            font-bold text-gray-800"
                        x-text="selectedProduct?.name"
                    ></h2>


                    {{-- Price --}}
                    <p
                        class="mt-4
                            text-2xl font-bold
                            text-pink-600"
                        x-text="
                            'Rp' + Number(selectedProduct?.price)
                                .toLocaleString('id-ID')
                        "
                    ></p>


                    {{-- Description --}}
                    <div class="mt-6">

                        <h3 class="font-semibold text-gray-800">
                            Deskripsi
                        </h3>

                        <p
                            class="mt-2
                                text-gray-600
                                leading-relaxed"
                            x-text="selectedProduct?.description"
                        ></p>

                    </div>


                    {{-- Add to Cart --}}
                    <form
                        :action="'{{ url('/keranjang/tambah') }}/' + selectedProduct?.id"
                        method="POST"
                        class="mt-8"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-full
                                py-3.5
                                rounded-full
                                bg-pink-600
                                hover:bg-pink-700
                                text-white
                                font-semibold
                                transition duration-300"
                        >
                            Tambah ke Keranjang
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    </div>

</section>


    {{-- =====================================================
        ABOUT US
    ====================================================== --}}

    <section
        id="about"
        class="bg-pink-50 py-16 sm:py-20 scroll-mt-20"
    >

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">

            {{-- Label --}}
            <p class="font-poppins text-center text-base sm:text-lg font-bold text-pink-600">
                About Us
            </p>

            {{-- Title --}}
            <h2 class="font-poppins text-center text-4xl sm:text-5xl font-bold text-[#1e4f8f] mt-2">
                Tentang Toko Kami
            </h2>


            <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

                {{-- ================= TEXT ================= --}}
                <div>

                    <h3 class="font-poppins text-2xl font-bold text-gray-800">
                        One Step Delicious
                    </h3>


                    <p class="mt-6 text-gray-600 leading-relaxed text-justify">
                        Selamat datang di <strong class="font-semibold text-gray-800">Bitebyay</strong>
                        — tempat di mana setiap gigitan menghadirkan kebahagiaan.
                        Bitebyay adalah toko online dessert yang menghadirkan berbagai
                        macam varian manis berkualitas, mulai dari mochi lembut dengan
                        berbagai isian favorit hingga dessert pilihan lainnya.
                    </p>


                    <p class="mt-5 text-gray-600 leading-relaxed text-justify">
                        Setiap produk kami dibuat dengan perhatian penuh terhadap rasa,
                        tekstur, dan kebersihan, sehingga aman dan lezat untuk nikmati
                        setiap saat. Bitebyay hadir untuk menemani momen spesialmu —
                        mulai dari jamuan santai, hadiah untuk orang tersayang, hingga
                        pelengkap acara istimewa.
                    </p>


                    {{-- Read More --}}
                    <a
                        href="{{ route('home') }}#contact"
                        class="mt-8 inline-block
                               px-6 py-3
                               bg-pink-800 hover:bg-pink-900
                               text-white font-semibold
                               rounded-md
                               shadow transition duration-300"
                    >
                        Read More
                    </a>

                </div>

                {{-- ================= IMAGE ================= --}}
                <div class="bg-white rounded-xl p-3 shadow-sm">

                    <div class="relative overflow-hidden rounded-lg">

                        <img
                            src="{{ asset('img/tokokue2.jpg') }}"
                            alt="Dessert BitebyAy"
                            class="w-full h-[300px] sm:h-[380px] object-cover"
                        >

                        {{-- Location Pin --}}
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="grid place-items-center w-14 h-14 rounded-full bg-gray-900/90 text-white shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-7 h-7"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
        CONTACT
    ====================================================== --}}

    <section
        id="contact"
        class="bg-white py-16 sm:py-20 scroll-mt-20"
    >

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">

            {{-- Label --}}
            <p class="font-poppins text-center text-base sm:text-lg font-bold text-pink-600">
                Contact
            </p>

            {{-- Title --}}
            <h2 class="font-poppins text-center text-4xl sm:text-5xl font-bold text-[#1e4f8f] mt-2">
                Hubungi Kami
            </h2>

            <p class="mt-4 text-center text-gray-600 max-w-2xl mx-auto">
                Punya pertanyaan atau ingin memesan dessert untuk acara spesial?
                Kami siap membantu Anda.
            </p>


            {{-- ================= KARTU INFORMASI ================= --}}
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Alamat --}}
                <div class="bg-pink-50 rounded-xl p-6 shadow-sm border border-pink-100
                            hover:shadow-md transition duration-300">

                    <div class="w-12 h-12 rounded-full bg-white text-pink-600
                                flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>

                    <h3 class="font-poppins text-lg font-bold text-gray-800 mt-5">
                        Alamat
                    </h3>

                    <p class="mt-3 text-sm sm:text-base text-gray-600 leading-relaxed">
                        Takkalao, Parepare - Sulawesi Selatan
                    </p>

                    <a href="https://www.google.com/maps/search/?api=1&query=Takkalao+Parepare+Sulawesi+Selatan"
                        target="_blank" rel="noopener"
                        class="inline-block mt-4 text-sm font-semibold text-pink-600 hover:text-pink-700 transition">
                        Lihat di Maps →
                    </a>

                </div>


                {{-- Kontak --}}
                <div class="bg-pink-50 rounded-xl p-6 shadow-sm border border-pink-100
                            hover:shadow-md transition duration-300">

                    <div class="w-12 h-12 rounded-full bg-white text-pink-600
                                flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>

                    <h3 class="font-poppins text-lg font-bold text-gray-800 mt-5">
                        Kontak
                    </h3>

                    <a href="https://wa.me/62895324738587" target="_blank" rel="noopener"
                        class="mt-3 flex items-center gap-2 text-sm sm:text-base text-gray-600 hover:text-pink-600 transition">
                        +62895324738587
                    </a>

                    <a href="mailto:bitebyay@gmail.com"
                        class="mt-1 flex items-center gap-2 text-sm sm:text-base text-gray-600 hover:text-pink-600 transition">
                        bitebyay@gmail.com
                    </a>

                </div>


                {{-- Jam Operasional --}}
                <div class="bg-pink-50 rounded-xl p-6 shadow-sm border border-pink-100
                            hover:shadow-md transition duration-300">

                    <div class="w-12 h-12 rounded-full bg-white text-pink-600
                                flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>

                    <h3 class="font-poppins text-lg font-bold text-gray-800 mt-5">
                        Jam Operasional
                    </h3>

                    <p class="mt-3 text-sm sm:text-base text-gray-600 leading-relaxed">
                        Senin - Minggu : 07.00 - 22.00
                    </p>

                </div>


                {{-- Ikuti Kami --}}
                <div class="bg-pink-50 rounded-xl p-6 shadow-sm border border-pink-100
                            hover:shadow-md transition duration-300">

                    <div class="w-12 h-12 rounded-full bg-white text-pink-600
                                flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>

                    <h3 class="font-poppins text-lg font-bold text-gray-800 mt-5">
                        Ikuti Kami
                    </h3>

                    <div class="mt-4 flex items-center gap-4">

                        <a href="#" title="YouTube" aria-label="YouTube"
                            class="text-gray-500 hover:text-pink-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814ZM9.545 15.568V8.432L15.818 12l-6.273 3.568Z" />
                            </svg>
                        </a>

                        <a href="#" title="TikTok" aria-label="TikTok"
                            class="text-gray-500 hover:text-pink-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07Z" />
                            </svg>
                        </a>

                        <a href="#" title="Facebook" aria-label="Facebook"
                            class="text-gray-500 hover:text-pink-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073Z" />
                            </svg>
                        </a>

                        <a href="#" title="Instagram" aria-label="Instagram"
                            class="text-gray-500 hover:text-pink-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.75 3h8.5A4.75 4.75 0 0 1 21 7.75v8.5A4.75 4.75 0 0 1 16.25 21h-8.5A4.75 4.75 0 0 1 3 16.25v-8.5A4.75 4.75 0 0 1 7.75 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.5 6.5h.01" />
                            </svg>
                        </a>

                    </div>

                </div>

            </div>


            {{-- ================= PETA & TOMBOL ================= --}}
            <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">

                {{-- Map --}}
                <div class="bg-pink-50 rounded-xl overflow-hidden shadow-sm border border-pink-100">
                    <iframe
                        title="Lokasi BitebyAy"
                        src="https://www.google.com/maps?q=Takkalao,+Parepare,+Sulawesi+Selatan&output=embed"
                        class="w-full h-full min-h-[320px] border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>


                {{-- Aksi --}}
                <div class="bg-pink-50 rounded-xl p-8 shadow-sm border border-pink-100
                            flex flex-col justify-center">

                    <h3 class="font-poppins text-2xl font-bold text-gray-800">
                        Pesan Sekarang
                    </h3>

                    <p class="mt-3 text-gray-600 leading-relaxed">
                        Hubungi kami lewat WhatsApp atau email untuk pemesanan dessert
                        untuk acara Anda. Tim kami akan membalas pada jam operasional.
                    </p>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">

                        <a href="https://wa.me/62895324738587" target="_blank" rel="noopener"
                            class="inline-flex items-center justify-center
                                   px-6 py-3
                                   bg-pink-600 hover:bg-pink-700
                                   text-white font-semibold
                                   rounded-md transition duration-300">
                            Chat WhatsApp
                        </a>

                        <a href="mailto:bitebyay@gmail.com"
                            class="inline-flex items-center justify-center
                                   px-6 py-3
                                   bg-white hover:bg-pink-50
                                   border border-pink-200 hover:border-pink-400
                                   text-pink-700 font-semibold
                                   rounded-md transition duration-300">
                            Kirim Email
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection