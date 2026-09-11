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
        class="relative w-full h-[calc(100vh-80px)] min-h-[600px] overflow-hidden"
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
    class="bg-white py-20 sm:py-24"
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
        ABOUT
    ====================================================== --}}

    <section
        id="about"
        class="bg-pink-50 py-20"
    >

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 text-center">

            <p class="text-pink-600 font-semibold mb-3">
                About BitebyAy
            </p>

            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">
                Dessert untuk Setiap Momen
            </h2>

            <p class="max-w-2xl mx-auto mt-5 text-gray-600 leading-relaxed">
                BitebyAy menghadirkan berbagai pilihan dessert
                dengan cita rasa yang lezat dan dibuat dengan
                bahan berkualitas untuk menemani setiap momen Anda.
            </p>

        </div>

    </section>


    {{-- =====================================================
        CONTACT
    ====================================================== --}}

    <section
        id="contact"
        class="bg-white py-20"
    >

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 text-center">

            <p class="text-pink-600 font-semibold mb-3">
                Contact
            </p>

            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">
                Hubungi BitebyAy
            </h2>

            <p class="mt-4 text-gray-500">
                Kami siap membantu pesanan dessert Anda.
            </p>

        </div>

    </section>

@endsection